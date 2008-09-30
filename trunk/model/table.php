<?php

// Classe que representa uma tabela do BD

class Table {

  var $nome;
  var $propriedades; // array que guarda os campos comuns da tabela (exceto os chaves)
  var $chaves;       // array que guarda os campos chave da tabela

  function Table() {
    $this->nome = '';
    $this->propriedades = array();
    $this->chaves = array();
  }

  // seta uma propriedade $p com o valor $v
  function set($p, $v) {
    // checar se $p existe entre as propriedades do objeto
    $this->propriedades[$p] = $v;
  }
  // retorna uma propriedade $p
  function get($p) {
    return $this->propriedades[$p];
  }
  function setChave($p, $v) {
    $this->chaves[$p] = $v;
  }
  function getChave($p) {
    return $this->chaves[$p];
  }

}

?>