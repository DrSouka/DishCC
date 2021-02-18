<?php
/*
 * User: Samuel Meyer
 * Date: 11.02.2021
 * Updated by :
 *
 */

/*session_start();*/

$controlerFiles = glob( __DIR__ . '/controler/*.php');
foreach($controlerFiles as $file){require($file);}

if(!isset($_GET['action'])){$_GET['action'] = 'home';}
switch ($_GET['action']) {

  /*
   *
   *  PAGES
   *
   */

  /*
   *
   *  FEATURES
   *
   */

  /* DEFAULT */
  default :
    home();
  break;
}
