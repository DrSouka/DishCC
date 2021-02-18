<?php
/**
 * User: Samuel Meyer
 * Date: 25.10.2020
 * Updated by :
 *
 */

class Form{
  public $title;
  public $method;
  public $action;
  public $elements = array();

  function set_Title($title){$this->title = $title;}
  function get_Title(){return $this->title;}

  function set_Method($method){$this->method = $method;}
  function get_Method(){return $this->method;}

  function set_Action($action){$this->action = $action;}
  function get_Action(){return $this->action;}

  function add_Element($element){$this->elements[] = $element;}
  function get_Elements(){return $this->elements;}

  function WriteForm(){
    $html = '';
    $title = $this->title;

    $html .= "<form method='". $this->method ."' action='". $this->action ."'>";
    $html .= '<h2>'. $title .'</h2>';
    foreach($this->elements as $formElement){
      $html .= $formElement->WriteInForm();
    }
    $html .= '</form>';
    return $html;
  }
}

class FormElement{
  public $label;
  public $name;
  public $item_type;
  public $type;
  public $text;
  public $action;
  public $priority;
  public $required;
  public $placeholder;

  function set_Label($label){$this->label = $label;}
  function get_Label(){return $this->label;}

  function set_Name($name){$this->name = $name;}
  function get_Name(){return $this->name;}

  function set_Item_Type($item_type){$this->item_type = $item_type;}
  function get_Item_Type(){return $this->item_type;}

  function set_Type($type){$this->type = $type;}
  function get_Type(){return $this->type;}

  function set_Text($text){$this->text = $text;}
  function get_Text(){return $this->text;}

  function set_Action($action){$this->action = $action;}
  function get_Action(){return $this->action;}

  function set_Priority($priority){$this->priority = $priority;}
  function get_Priority(){return $this->priority;}

  function set_Required($required){$this->required = $required;}
  function get_Required(){return $this->required;}

  function set_Placeholder($placeholder){$this->placeholder = $placeholder;}
  function get_Placeholder(){return $this->placeholder;}

  function WriteInForm(){
    $html = '';
    $label = $this->label;
    $name = $this->name;
    $item_type = $this->item_type;
    $type = $this->type;
    $text = $this->text;
    $action = $this->action;
    $priority = $this->priority;
    $required = $this->required;
    $placeholder = $this->placeholder;

    if(empty($text)){
      if(!empty($label)){$html .= '<label>'. $label .'</label>';}
      if($item_type == 'button'){
        $html = "<button class='button ". $priority ."' type='". $type ."'>". $name .'</button>';
      }else{
        $html .= "<input class='". $type ."' type='". $type ."' name='". $name ."'";
        if(!empty($placeholder)){$html .= " placeholder='". $placeholder ."'";}
        if($required){$html .= ' required>';}else{$html .= '>';}
      }
    }else{
      switch($type){
        case 'link':
          $html = "<a href='index.php?action=". $action ."'>". $text .'</a>';
        break;

        default:
        break;
      }
    }
    return $html;
  }
}
