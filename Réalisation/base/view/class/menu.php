<?php
/**
 * User: Samuel Meyer
 * Date: 10.10.2020
 * Updated by :
 *
 */

class MenuElement{
  public $title;
  public $action;
  public $type;
  public $privilege;
  public $privilege_comparison;
  public $dropdown = array();

  function set_Title($title){$this->title = $title;}
  function get_Title(){return $this->title;}

  function set_Action($action){$this->action = $action;}
  function get_Action(){return $this->action;}

  function set_Type($type){$this->type = $type;}
  function get_Type(){return $this->type;}

  function set_Privilege($privilege){$this->privilege = $privilege;}
  function get_Privilege(){return $this->privilege;}

  function set_Privilege_Comparison($privilege_comparison){$this->privilege_comparison = $privilege_comparison;}
  function get_Privilege_Comparison(){return $this->privilege_comparison;}

  function WriteInMenu($current_user_privilege){
    if(empty($this->action)){$this->action = str_replace(' ', '_', strtolower($this->title));}
    if(empty($this->privilege)){$this->privilege = 0;}
    if(empty($this->type)){$this->type = 'page';}

    if($this->privilege <= $current_user_privilege){
      return "<a class='". $this->type ."' href='index.php?action=". $this->action ."'>". $this->title ."</a>". PHP_EOL;
    }
  }

  function WriteDropdown($current_user_privilege){
    $html = '';

    if($this->privilege <= $current_user_privilege){
      $html .= "<div class='dropdown-content'>";
      foreach($this->dropdown as $subpage){
        $subpage->type = 'subpage';
        $html .= $subpage->WriteInMenu($current_user_privilege);
      }
      $html .= '</div>'. PHP_EOL;
    }
    return $html;
  }
}

function write_menu($menu){
  $current_user_privilege = 0;
  $html = '';

  foreach($menu as $menu_element){
    if(
      $current_user_privilege >= 1 &&
      $menu_element->privilege_comparison
    ){
      continue;
    }
    if(!empty($menu_element->dropdown)){
      $html .= "<div class='dropdown'>";
    }else{
      $html .= '<div>';
    }
    $html .= $menu_element->WriteInMenu($current_user_privilege);
    if(!empty($menu_element->dropdown)){
      $html .= $menu_element->WriteDropdown($current_user_privilege);
    }
    $html .= '</div>';
  }
  return $html;
}
