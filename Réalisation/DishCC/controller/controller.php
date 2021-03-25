<?php
/*
 * User: Samuel Meyer
 * Date: 11.02.2021
 * Updated by :
 *
 */

// Import all php classes
$classes = glob('view/class/*.php');
foreach($classes as $class){require_once($class);}

/**
 * Use the php file in view if the file name and value are sames
 * @param string $page
 */
function page_constructor($page){
  ob_start();
  global $message;
  require_once 'view/'. $_GET['action'] .'.php';

  $content = ob_get_clean();
  require_once "view/template.php";
}

/**
 * Init Home view
 */
function home(){
  page_constructor('Home');
}

/**
 * Init Sign up view
 */
function sign_up(){
    page_constructor("Sign up");
}

/**
 * @param string[] $sign_up_request [field => value]
 **/
function sign_up_check($sign_up_request){
  unset($_COOKIE['haveAccount']);
  global $message;
  require_once "model/dbManager.php";
  if(sizeof($sign_up_request) == 4){
    $check = true;
    $emailCheck = '';

    // Init variables value from db datas
    $emailCheck = select('email', 'user', array('email' => $sign_up_request['email']));

    // Check email in db
    if(isset($emailCheck[0]['email'])){
      if($sign_up_request['email'] == $emailCheck[0]['email']){
        $message['email'] = 'This email is already registred.';
        $check = false;
      }
    }

    // Check password constraints
    $minCharType = 0;
    if(isset($sign_up_request['password'])){
      $uppercase = false;
      $lowercase = false;
      $numeric = false;
      $special = false;

      foreach(str_split($sign_up_request['password']) as $char){
        if(is_numeric($char)){$numeric = true;}
        if(ctype_upper($char)){$uppercase = true;}
        if(ctype_lower($char)){$lowercase = true;}
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $char)){$special = true;}
      }

      if($uppercase){$minCharType++;}
      if($lowercase){$minCharType++;}
      if($numeric){$minCharType++;}
      if($special){$minCharType++;}
      if($minCharType >= 3){$minCharType = true;}

      if($sign_up_request['password'] != $sign_up_request['confirm']){
        $message['password'] = 'Password and confirm are not sames.';
        $check = false;
      }

      if(
          strlen($sign_up_request['password']) < 8 &&
          $minCharType
      ){
          $message['password'] = 'The password requires at least 8 characters and 3 different types of characters.';
          $check = false;
      }
    }
    // Account registration in db
    if($check){
      $datas['email'] = $sign_up_request['email'];
      $datas['password'] = password_hash($sign_up_request['password'], PASSWORD_DEFAULT);
      insert($datas, 'user'); // insert datas in db
      $_COOKIE['haveAccount'] = true;
      header('Location: index.php?action=sign_in');
      die();
    }else{
      sign_up();
    }
  }else{
    sign_up();
  }
}

/**
 * Init Sign in view
 */
function sign_in(){
    page_constructor("Sign in");
}

/**
 * @param string[] $sign_in_request [field => value]
 **/
function sign_in_check($sign_in_request){
  global $message;
  $_COOKIE['haveAccount'] = true;
  if(
      isset($sign_in_request['email']) &&
      isset($sign_in_request['password'])
  ){

    // Init variables value from db datas
    require_once "model/dbManager.php";
    $email = select('email', 'user', array('email' => $sign_in_request['email']));
    $password = select('password', 'user', array('email' => $sign_in_request['email']));
    $check = true;

    if(!isset($email[0]['email'])){
      $check = false;
    }

    // Sign in check and init session values
    if(
      $check &&
      password_verify($sign_in_request['password'], $password[0]['password'])
    ){
        createSession($sign_in_request);
        header('Location: index.php?action=calories_calculator');
	      die();
    }else{
        $message['general'] = 'Email or password is wrong.';
        sign_in();
    }
  }else{
      sign_in();
  }
}

/**
 * @param string[] $sign_in_request [field => value]
 **/
function createSession($sign_in_request){
  require_once "model/dbManager.php";
  $_SESSION['email'] = select('email', 'user', array('email' => $sign_in_request['email']))[0]['email'];
  $_SESSION['uid'] = select('id', 'user', array('email' => $sign_in_request['email']))[0]['id'];
  setcookie("haveAccount", true, time()+(60*60*24*7));
}

/**
 * Sign out
 **/
function sign_out(){
    session_unset();
    session_destroy();
    header('Location: index.php?action=home');
    die();
}

/**
 * Init Calories calculator in view
 */
function calories_calculator(){
    page_constructor("Calories calculator");
}

/**
 * @param string[] $modify_in_request [field => value]
 **/
function modify_password_check($modify_request){
  if(
    isset($modify_request['cPassword']) &&
    isset($modify_request['password']) &&
    isset($modify_request['confirm'])
  ){
    // Init variables value from db datas
    require_once "model/dbManager.php";
    $password = select('password', 'user', array('email' => $_SESSION['email']));
    $check = true;

    if(!isset($password)){$check = false;}

    if($modify_request['password'] != $modify_request['confirm']){$check = false;}

    if(
      $check &&
      password_verify($modify_request['cPassword'], $password[0]['password'])
    ){
      update(array('password' => password_hash($modify_request['cPassword'], PASSWORD_DEFAULT)), 'user', $_SESSION['uid']);
    }
  }
}

/**
 * Init Search a dish view
 */
function search_a_dish(){
  page_constructor('Search a dish');
}

/**
 * Init My history view
 */
function my_history(){
  page_constructor('My history');
}

/**
 * Init Suggest a dish view
 */
function suggest_a_dish(){
  page_constructor('Suggest a dish');
}

function check_suggest_a_dish($request){
  require_once "model/dbManager.php";
  if(
    isset($request['name']) &&
    isset($request['category']) &&
    isset($request['type']) &&
    isset($request['nbPerson']) &&
    isset($request['pTime']) &&
    isset($request['cTime']) &&
    isset($request['difficulty']) &&
    isset($request['recipe'])
  ){
    if($check){
      $datas['name'] = $request['name'];
      $datas['nperson'] = $request['nbPerson'];
      $datas['tpreparation'] = $request['pTime'];
      $datas['tcooking'] = $request['cTime'];
      $datas['category'] = $request['category'];
      $datas['type'] = $request['type'];
      $datas['author'] = $_SESSION['uid'];
      $datas['difficulty'] = $request['difficulty'];
      $datas['recipe'] = $request['recipe'];

      insert($datas, 'dish');
      header('Location: index.php?action=suggest_a_dish');
      die();
    }
  }else{
    suggest_a_dish();
  }
}
