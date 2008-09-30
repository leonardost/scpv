<?php

class Label {

  var $for;
  var $label;
  var $classe;

  function Label($for = '', $label = '', $classe = '') {
    $this->for = $for;
    $this->label = $label;
    $this->classe = $classe;
  }

  function display() {
    printf('<label for="%s"', $this->for);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    } 
    printf(">%s</label>\n", $this->label);
  }

}

?>