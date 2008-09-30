<?php

include('control/control.php');
include('model/usuariodao.php');

class LoginControl extends Control {

  var $user;

  function LoginControl() {

    session_start();

    if ($_GET['action'] == 'logout') {
      $_SESSION['logado'] = false;
      $_SESSION['login'] = '';
      session_destroy();
      header('Location: index.php');
      exit();
    }

    $this->validar($_POST, 'usuario');

    $usuario = new UsuarioDAO();
    $usuario->setChave('login','\'' . $_SESSION['usuario']['login'] . '\'');
    $usuario->set('senha','\'' . md5($_SESSION['usuario']['senha']) . '\'');

    $this->user = new UsuarioDAO();
    $this->user->setChave('login', '\'' . $_SESSION['usuario']['login'] . '\'');

    //echo '<pre>';
    //print_r($_SESSION);
    //echo '</pre>';

    // faz login
    // checa se o usuario com a senha fornecida estão no BD
    if ($_POST['logar']) {
      if ($usuario->checar()) {
        $_SESSION['logado'] = true;
        $_SESSION['login'] = $_SESSION['usuario']['login'];
        $_SESSION['nivel'] = $usuario->nivel();
        header('Location: alunos.php');
        exit();
      }
      else {
        $_SESSION['erros']['login'] = true;
        //header('Location: index.php');
      }
      //exit();
    }

    // cadastro de usuarios
    if ($_POST['cadastrar']) {

      if (md5($_SESSION['usuario']['senha']) != md5($_SESSION['usuario']['senha2'])) {
        $_SESSION['erros']['senha']['NAO_CONFERE'] = true;
        //header('Location: index.php?action=cadastro');
      }

      if ($usuario->inserir() && count($_SESSION['erros'] == 0)) {
        header('Location: index.php');
      }
      else {
        header('Location: index.php?action=cadastro');
      }

      exit();
    }

  }

}

?>