<?php
/**
 * User: Samuel Meyer
 * Date: 03.11.2020
 * Updated by :
 *
 */

$form = new Form();
$form->set_Method('POST');
$form->set_Action('sign_in');
$form->set_Title('Welcome back !');

$formElement = new FormElement();
$formElement->set_Name('input_Id');
$formElement->set_Type('text');
$formElement->set_Required(true);
$formElement->set_Placeholder('Pseudo');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Password');
$formElement->set_Type('password');
$formElement->set_Required(true);
$formElement->set_Placeholder('Password');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Text('Forgot password ?');
$formElement->set_Type('link');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('Sign in');
$formElement->set_Priority('first');
$formElement->set_Type('submit');
$formElement->set_Item_Type('button');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Text("Don't have an account ?");
$formElement->set_Type('link');
$formElement->set_Action('sign_up');
$form->add_Element($formElement);
