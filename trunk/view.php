<?php

//include('form.php');

function write_upper() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
  <title>Cursinho comunitário da UFSCar</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" type="text/css" href="estilo.css" />
  <script language="javascript" type="text/javascript" src="scripts.js"></script>
</head>
<body>

  <div id="wrapper">
<?php
}

function write_header() {
?>
  <div id="topo"><h1>Curso pré-vestibular da UFSCar</h1></div>
<?php
}

// como o menu ainda vai mudar muito, melhor fazer uma função que o escreve (poderíamos linkar com um bd tb)
function write_menu() {
?>
    <div id="menu">
      <ul>
        <li><a href="alunos.php">Alunos</a>
          <ul>
            <li><a href="alunos.php?action=cadastro">Cadastro</a></li>
            <li><a href="alunos.php?action=questionario">Questionário</a></li>
            <li><a href="alunos.php?action=consulta">Consulta</a></li>
            <li><a href="alunos.php?action=listagem">Listagem</a></li>
          </ul>
        </li>
        <!--<li><a href="atividades.php">Atividades</a>
          <ul>
            <li><a href="#">Cadastro</a></li>
          </ul>
        </li>
        <li><a href="docentes.php">Docentes</a></li>-->
        <li><a href="relatorios.php">Relatórios</a>
        </li>
        <li><a href="administracao.php">Administração</a>
          <ul>
            <li><a href="administracao.php?action=usuarios">Usuários</a></li>
            <li><a href="administracao.php?action=questionario">Questionário</a></li>
          </ul>
        </li>
      </ul>
      <div>
        <p>Logado como <?php echo $_SESSION['login'] ?> - <a href="index.php?action=logout">sair</a></p>
      </div>
    </div>

    <div id="conteudo">
<?php
}

function write_footer() {
?>
    </div>

    <div id="rodape"><p>&copy; 2008 - UFSCar</p></div>
<?php
}

function write_down() {
?>
  </div>

</body>
</html>
<?php
}

?>