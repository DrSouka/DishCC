<?php
/**
* User: Samuel Meyer
* Date: 04.02.2021
* Updated by :
*
*/

require 'view/helper/import-classes.php';

function page_constructor($page){
  global $errorMessages;

  ob_start();
  require 'view/'. $_GET['action'] .'.php';

  $content = ob_get_clean();
  require "view/template.php";
}

function home(){
  page_constructor("Home");
}
