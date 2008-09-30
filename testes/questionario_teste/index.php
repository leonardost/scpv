<?php

// por enquanto, vou deixar esta idéia arquivada, porque ela se tornará bastante complexa

  include('rotinas.php');

  conectar();

  selecionar_banco('cursinho');

  $resultado = query('SELECT * FROM questionario');

  if (!$resultado) {
    $num_questoes = 0;
  }
  else {
    $num_questoes = num_rows($resultado);
  }
    //die('hummm');

//  echo num_rows($resultado);

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

    <form id="frmQuestionario" name="frmQuestionario">

<?php

  for ($i = 0; $i < $num_questoes; ++$i) {

  }

?>

    </form>

<?php
  if (!$num_questoes) {
    printf('      <h2 id="nenhuma_questao">Ainda não há nenhuma questão neste questionário</h2>' . "\n");
    printf('      <a id="adicionar_nova_questao" href="#">adicionar nova questão</a>' . "\n");
  }
?>

  </div>

</body>
</html>
<?php
  desconectar();
?>