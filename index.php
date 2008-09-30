<?php

  include('control/logincontrol.php');
  include('view.php');

  $l = new LoginControl();

  write_upper();

  write_header();

?>

<?php
  if (!$_SESSION['logado']) {
?>
    <div id="menu">
      <form id="frmLogin" method="post" action="index.php">
<?php  if ($_SESSION['erros']['login']) printf("      <p class=\"erro\">login e/ou senha inválidos!</p>\n"); ?>
        <label for="login">Login</label><input id="login" name="login|!" type="text" maxlength="255" value="<?php echo $_SESSION['usuario']['login'] ?>" />
        <label for="senha">Senha</label><input id="senha" name="senha|!" type="password" maxlength="255" />
        <input id="btnLogin" name="logar" class="botao" type="submit" value="Login" />
      </form>
    </div>

    <div id="conteudo">
<?php
  }
  else {
    write_menu();
  }

?>

      <h1>Últimas notícias</h1>

      <h2>Inaugurado o site do cursinho comunitário da UFSCar</h2>
      <p>Foi inaugurado este site. Usem-no com cuidado!</p>

<?php
  unset($_SESSION['usuario']);
  unset($_SESSION['erros']);

  write_footer();

  write_down();
?>