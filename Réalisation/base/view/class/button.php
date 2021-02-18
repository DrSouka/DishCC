<?php
/**
 * User: Samuel Meyer
 * Date: 11.02.2020
 * Updated by :
 *
 */

class formButton{
  public $text;
  public $type;
  public $className;

  function set_Text($text){$this->text = $text;}
  function set_Type($type){$this->type = $type;}
  function set_ClassName($className){$this->className = $className;}

  function writeButton(){
    return "<button class='". $className ."' type='". $type ."'>". $text ."'</button>";
  }
}

class button{
  public $action;
  public $text;
  public $className;

  function set_Action($action){$this->action = $action;}
  function set_Text($text){$this->text = $text;}
  function set_ClassName($className){$this->className = $className;}

  function writeButton(){
    return "<div class='". $className ."' onclick='openPage(". $action .")'>". $text .'</div>";
  }
}
