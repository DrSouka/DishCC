<?php
/**
 * User: Samuel Meyer
 * Date: 10.10.2020
 * Updated by :
 *
 */

$menu = array();


$page = new MenuElement();
$page->set_Title('HOME');
$menu[] = $page;


$page = new MenuElement();
$page->set_Title('SIGN IN');
$page->set_Type('feature');
$page->set_Privilege_Comparison(true);
$menu[] = $page;


$page = new MenuElement();
$page->set_Title('SIGN UP');
$page->set_Type('feature');
$page->set_Privilege_Comparison(true);
$menu[] = $page;


$page = new MenuElement();
$page->set_Title('PROFILE');
$page->set_Privilege(1);

$subpage = new MenuElement();
$subpage->set_Title('HISTORY');
$page->dropdown[] = $subpage;

$subpage = new MenuElement();
$subpage->set_Title('USERS');
$subpage->set_Privilege(2);
$page->dropdown[] = $subpage;

$subpage = new MenuElement();
$subpage->set_Title('SIGN OUT');
$subpage->set_Privilege(1);
$page->dropdown[] = $subpage;

$menu[] = $page;
