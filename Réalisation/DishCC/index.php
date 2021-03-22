<?php
/*
 * User: Samuel Meyer
 * Date: 11.02.2021
 * Updated by :
 *
 */

// Session creation
//session_set_cookie_params(60*60*24*14, null, null, true, null);
session_start();

// DB connection
require_once 'model/dbConnector.php';
try{
	$db = new Db;
}catch (PDOException $exception) {
    echo 'Connection failed: ' . $exception->getMessage();
    die();
}

// Import all files in controller folder
$controlerFiles = glob( __DIR__ . '/controller/*.php');
foreach($controlerFiles as $file){require_once($file);}

if(!isset($_GET['action'])){$_GET['action'] = 'home';}
switch ($_GET['action']) {

  /*
   *
   *  PAGES
   *
   */

  case 'calories_calculator' :
    calories_calculator();
  break;

	case 'search_a_dish' :
	 search_a_dish();
	break;

	case 'my_history' :
		my_history();
	break;

	case 'suggest_a_dish' :
	 suggest_a_dish();
	break;

  /*
   *
   *  FEATURES
   *
   */

  case 'sign_up' :
    sign_up_check($_POST);
  break;

  case 'sign_in' :
    sign_in_check($_POST);
  break;

  case 'sign_out' :
    sign_out();
  break;

  case 'modify_password' :
    modify_password_check($_POST);
  break;

  case 'save_in_history' :
    save_in_history($_POST);
  break;

  /* DEFAULT */
  default :
		case 'home':
	    home();
	  break;
  break;
}
