<?php

//
// Classe de conexão com banco de dados
//

class Conexao {

  var $host;
  var $user;
  var $pass;
  var $tipo_banco;
  /*
    1 = MySQL
    2 = ...
    (Implementar mais pra frente)
  */
  var $banco;        // nome do banco selecionado

  var $conexao;

  /*
    Construtor
  */
  function Conexao($h = 'localhost', $u = 'root', $p = '') {
    $this->host = $h;
    $this->user = $u;
    $this->pass = $p;
    $this->tipo_banco = 1;
    
    $this->conexao = $this->conectar();
    if (!$this->conexao) {
      echo ('Erro na conexão!');
      exit;
    }
    $this->selecionar_banco('cursinho');
  }

  function conectar() {
    switch ($this->tipo_banco) {
      case 1:
        return mysql_connect($this->host, $this->user, $this->pass);
        break;
    }
  }

  function desconectar() {
    switch ($this->tipo_banco) {
      case 1:
        mysql_close($this->conexao);
        break;
    }
  }

  private function selecionar_banco($b = '') {
    $this->banco = $b;
    switch ($this->tipo_banco) {
      case 1:
        mysql_select_db($this->banco, $this->conexao)
          or die("O banco " . $this->banco . " não pôde ser selecionado!");
    }
  }

  function query($sql) {
    switch ($this->tipo_banco) {
      case 1:
        return mysql_query($sql);
        break;
    }
  }

  function num_rows($res) {
  	// $res = resource
    switch ($this->tipo_banco) {
      case 1:
        return mysql_num_rows($res);
        break;
    }
  }

  function fetch_array($res) {
    switch ($this->tipo_banco) {
      case 1:
        return mysql_fetch_array($res);
        break;
    }
  }

}
 
?>