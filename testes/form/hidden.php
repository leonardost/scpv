<?php

class Hidden {

  var $id;
  var $name;
  var $value;

  function Hidden($id, $name, $value) {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
  }

  function display() {
    printf('<input id="%s" name="%s" type="hidden" value="%s" />',
      $this->id, $this->name, $this->value);
    printf("\n");
  }

}

?>