<?php
/*
 * User: Samuel Meyer
 * Date: 11.02.2021
 * Updated by :
 *
 */

/**
 * Use the php file in view if the file name and value are sames
 * @param string $page
 */
function page_constructor($page){
    ob_start();
    require 'view/'. $_GET['action'] .'.php';

    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * Init home view
 */
function home(){
    page_constructor("Home");
}