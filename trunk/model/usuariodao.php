<?php

include('tabledao.php');

class UsuarioDAO extends TableDAO {

  function UsuarioDAO() {
    $this->conexao = new Conexao();
    $this->nome = 'usuarios';
    $this->chaves = array('login' => '');
    $this->propriedades = array('senha' => '', 'nivel' => 0);
  }

  // ve se o login já existe
  function pesquisar() {
    $sql = 'SELECT login FROM usuarios WHERE login = ' . $this->get('login');
    $r = $this->conexao->query($sql);
    if ($this->conexao->num_rows($r) == 1)
      return true;
    else
      return false;
  }

  // checa se o login e a senha conferem
  function checar() {
    $sql = 'SELECT login, senha FROM usuarios WHERE ' .
      'login = ' . $this->getChave('login') . ' AND ' .
      'senha = ' . $this->get('senha');
    $r = $this->conexao->query($sql);
    if ($this->conexao->num_rows($r) == 1)
      return true;
    else
      return false;
  }

  // retorna o nivel de acesso do usuario
  function nivel() {
    $sql = 'SELECT nivel FROM usuarios WHERE ' .
      'login = ' . $this->getChave('login') . ' AND ' .
      'senha = ' . $this->get('senha');
    $r = $this->conexao->query($sql);
    $registro = $this->conexao->fetch_array($r);
    $nivel = $registro['nivel'];
    return $nivel;
  }

}

?>