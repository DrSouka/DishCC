<?php
/*
 * User: Samuel Meyer
 * Date: 11.02.2021
 * Updated by :
 *
 */

// Session creation
//session_set_cookie_params(60*60*24*7, null, null, true, null);
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

  /* DEFAULT */
  default :
    home();
  break;
}
