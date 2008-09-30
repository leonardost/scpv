<?php

class Element {

  var $texto;

  function Element($texto = '') {
    $this->texto = $texto;
  }

  function display() {
    printf("%s\n", $this->texto);
  }

}

?>