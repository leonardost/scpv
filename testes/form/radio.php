<?php

// como pôr labels em cada radiobutton?
// por enquanto, vou com a solução de propriedade label em cada um
class Radio {
  var $id;
  var $name;
  var $choices;
  var $numchoices;

  function Radio($id = '', $name = '') {
    $this->id = $id;
    $this->name = $name;
    $this->choices = array();
    $this->numchoices = 0;
  }

  function addChoice($id, $classe, $value, $checked, $label) {
    $this->choices[$this->numchoices++] = new Radiobutton($id, $this->name, $classe, $value, $checked, $label);
  }

  function display() {
    for ($i = 0; $i < $this->numchoices; $i++) {
      $this->choices[$i]->display();
    }
  }

}

class Radiobutton {
  var $id;
  var $name;
  var $classe;
  var $value;
  var $checked;
  var $label;

  function Radiobutton($id = '', $name = '', $classe = '', $value = '', $checked = '', $label = '') {
    $this->id = $id;
    $this->name = $name;
    $this->classe = $classe;
    $this->value = $value;
    $this->checked = $checked;
    $this->label = $label;
  }

  function display() {
    printf('<input id="%s" name="%s" type="radio" value="%s"', $this->id, $this->name, $this->value);
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