<?php

class Checkbox {
  var $id;
  var $name;
  var $classe;
  var $value;
  var $checked;
  var $label;
//  var $classelabel;

  function Checkbox($id = '', $name = '', $classe = '', $value = '', $checked = '', $label = '') {
    $this->id = $id;
    $this->name = $name;
    $this->classe = $classe;
    $this->value = $value;
    $this->checked = $checked;
    $this->label = $label;
  }

  function display() {
    printf('<input id="%s" name="%s" type="checkbox" value="%s"', $this->id, $this->name, $this->value);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    if ($this->checked) {
      printf(' checked="true"');
    }
    printf(">");
    if ($this->label != '') {
      printf('<label for="%s">%s</label>', $this->id, $this->label);
    }
    printf("\n");
  }

}

?>