<?php

// Classe que tem as funções comuns à todas as tabelas

include('conexao/conexao.php');
include('table.php');

class TableDAO extends Table {

  var $conexao;

  function inserir() {
    $sql = 'INSERT INTO ' . $this->nome . ' (';
    foreach (array_keys($this->chaves) as $campo)
      $sql .= $campo . ', ';
    foreach (array_keys($this->propriedades) as $campo)
      $sql .= $campo . ', ';
    $sql = substr($sql, 0, -2);
    $sql .= ') VALUES ( ';
    foreach ($this->chaves as $valor)
      $sql .= $valor . ', ';
    foreach ($this->propriedades as $valor)
      $sql .= $valor . ', ';
    $sql = substr($sql, 0, -2);
    $sql .= ')';
    $r = $this->conexao->query($sql);
    //echo $sql;
    if (!$r)
      return false;
    else
      return true;
  }

  function alterar() {
    $sql = 'UPDATE ' . $this->nome . ' SET ';
    foreach ($this->propriedades as $k=>$v)
      $sql .= $k . ' = ' . $v . ', ';
    $sql = substr($sql, 0, -2);
    $sql .= ' WHERE ';
    foreach ($this->chaves as $k=>$v)
      $sql .= $k . ' = ' . $v . ' AND ';
    $sql = substr($sql, 0, -5);
    $r = $this->conexao->query($sql);
    //echo $sql;
    if (!$r)
      return false;
    else
      return true;
  }

  function remover() {
    $sql = 'DELETE FROM ' . $this->nome . ' WHERE ';
    foreach ($this->chaves as $k=>$v)
      $sql .= $k . ' = ' . $v . ' AND ';
    $sql = substr($sql, 0, -5);
    $r = $this->conexao->query($sql);
    if (!$r)
      return false;
    else
      return true;
  }

}

?>