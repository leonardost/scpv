<?php

class Input {

  var $id;
  var $name;
  var $value;
  var $maxlenght;
  var $classe;
  var $password;

  function Input($id = '', $name = '', $value = '', $maxlenght = '', $classe = '', $password = '') {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->maxlenght = $maxlenght;
    $this->classe = $classe;
    $this->password = $password;
  }

  function display() {
    printf('<input id="%s" name="%s" value="%s" maxlenght="%d" type="',
      $this->id, $this->name, $this->value, $this->maxlenght);
    if ($this->password) {
      printf('password');
    }
    else {
      printf('text');
    }
    printf('"');
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    printf(">\n");
  }

}

?>