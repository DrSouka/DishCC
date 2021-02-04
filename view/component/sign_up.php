<?php
/**
 * User: Samuel Meyer
 * Date: 12.11.2020
 * Updated by :
 *
 */

$form = new Form();
$form->set_Method('POST');
$form->set_Action('sign_up');
$form->set_Title('Welcome among us !');

$formElement = new FormElement();
$formElement->set_Name('input_Pseudo');
$formElement->set_Type('text');
$formElement->set_Required(true);
$formElement->set_Placeholder('Pseudo');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Firstname');
$formElement->set_Type('text');
$formElement->set_Required(true);
$formElement->set_Placeholder('Firstname');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Lastname');
$formElement->set_Type('text');
$formElement->set_Required(true);
$formElement->set_Placeholder('Lastname');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Email');
$formElement->set_Type('email');
$formElement->set_Required(true);
$formElement->set_Placeholder('E-Mail');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Password');
$formElement->set_Type('password');
$formElement->set_Required(true);
$formElement->set_Placeholder('Password');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('input_Confirm');
$formElement->set_Type('password');
$formElement->set_Required(true);
$formElement->set_Placeholder('Confirm');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Name('Sign up');
$formElement->set_Priority('first');
$formElement->set_Type('submit');
$formElement->set_Item_Type('button');
$form->add_Element($formElement);

$formElement = new FormElement();
$formElement->set_Text("Already have an account ?");
$formElement->set_Type('link');
$formElement->set_Action('sign_in');
$form->add_Element($formElement);
