<?php

class Textarea {

  var $id;
  var $name;
  var $value;
  var $rows;
  var $cols;
  var $classe;

  function Textarea($id = '', $name = '', $value = '', $rows = '', $cols = '', $classe = '') {
    $this->id = $id;
    $this->name = $name;
    $this->value = $value;
    $this->rows = $rows;
    $this->cols = $cols;
    $this->classe = $classe;
  }

  function display() {
    printf('<textarea id="%s" name="%s" rows="%d" cols="%s"',
      $this->id, $this->name, $this->rows, $this->cols);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    printf(">%s</textarea>\n", $this->value);
  }

}

?>