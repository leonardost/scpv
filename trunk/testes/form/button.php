<?php

class Submit {

  var $id;
  var $name;
  var $value;
  var $classe;

  function Submit($id, $name, $value, $classe) {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->classe = $classe;
  }

  function display() {
    printf('<input id="%s" name="%s" type="submit" value="%s"',
      $this->id, $this->name, $this->value);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    printf(" />\n");
  }

}

class Reset {

  var $id;
  var $name;
  var $value;
  var $classe;

  function Reset($id, $name, $value, $classe) {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->classe = $classe;
  }

  function display() {
    printf('<input id="%s" name="%s" type="reset" value="%s"',
      $this->id, $this->name, $this->value);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    printf(" />\n");
  }

}

?>