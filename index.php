<?php
/**
 * User: Samuel Meyer
 * Date: 04.02.2021
 * Updated by :
 *
 */

/*session_start();*/
require "controler.php";

$errorMessages = array();

/*
try{
	$db = new Db;
}catch (PDOException $exception) {
    echo 'Connection failed: ' . $exception->getMessage();
    die();
}
*/

if(!isset($_GET['action'])){$_GET['action'] = 'home';}
switch ($_GET['action']) {

  /*
   *
   *  PAGES
   *
   */

  case 'home' :
    home();
  break;

  /*
   *
   *  FEATURES
   *
   */

  case 'sign_in' :
    sign_in($_POST);
  break;

  case 'sign_up' :
    sign_up($_POST);
  break;

  case 'sign_out' :
    sign_out();
  break;

  /* DEFAULT */
  default :
    home();
  break;
}
