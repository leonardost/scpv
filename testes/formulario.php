<?php

  session_start();

  include('rotinas.php');




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
  <title>Cursinho comunitário da UFSCar</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" type="text/css" href="estilo.css" />
  <script language="javascript" type="text/javascript" src="scripts.js"></script>
  <script language="javascript" type="text/javascript" src="ajax.js"></script>
</head>
<body>

  <div id="wrapper">

    <div id="topo"><h1>Cursinho comunitário da UFSCar</h1></div>

    <div id="menu">
<?php
  if (!$_SESSION['logado']) {
?>
      <form id="frmLogin" method="post" action="index.php">
        <label for="txtLogin">Login</label><input id="txtLogin" name="txtLogin" type="text" maxlength="255" />
        <label for="txtSenha">Senha</label><input id="txtSenha" name="txtSenha" type="pass" maxlength="255" />
        <input id="btnLogin" name="btnLogin" class="botao" type="submit" value="Login" />
      </form>
<?php
  }
  else {
?>
      <ul>
        <li><a href="alunos.php">Alunos</a>
          <ul>
            <li><a href="alunos.php?action=cadastro">Cadastro</a></li>
            <li><a href="#">Alteração asdsadasdsad</a></li>
          </ul>
        </li>
        <li><a href="atividades.php">Atividades</a>
          <ul>
            <li><a href="#">Cadastro</a></li>
          </ul>
        </li>
        <li><a href="docentes.php">Docentes</a></li>
        <li><a href="administracao.php">Administração</a></li>
      </ul>
      <div>
        <p>Logado como <?php echo $_SESSION['username'] ?> - 
          <a href="index.php?action=logout">sair</a>
        </p>
      </div>
<?php
  }
?>
    </div>

    <div id="menu_esq">
      A
    <!-- As opções aqui dependem do nível de acesso do usuário que logar -->
    </div>

    <div id="conteudo">

      <h1>Últimas notícias</h1>

      <h2>Inaugurado o site do cursinho comunitário da UFSCar</h2>
      <p>Foi inaugurado este site. Usem-no com cuidado!</p>

    </div>

    <div id="rodape"><p>&copy; 2008 - UFSCar</p></div>

  </div>

</body>
</html>