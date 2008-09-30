<?php

  session_start();

  include('form_proto.php');

  $form = new Form('form_processing.php', 'POST');
  $form->addLabel('numero_inscricao', 'Número de inscrição', 'asdf');
  $form->addInput('numero_inscricao', 'numero_inscricao|!', 'asdf', 10, 'curto', false);
  $form->addElement('<br />');
  $form->addLabel('senha', 'Senha', 'asdf');
  $form->addInput('senha', 'senha|!', 'asdf', 20, 'curto', true);

//  $form->createElement('password', 'senha', 'senha|!', array('label' => 'Senha', 'maxlenght' => 100, 'class' => 'curto'), $_SESSION['aluno']['senha']);
//  $form->createElement('radio', 'coisas', 'coisas', array('label' => 'TV', 'checked' => 'true'), '');
//  $form->createElement('submit', 'enviar', 'enviar', '' , 'Enviar', '');
//  $form->createElement('reset', 'resetar', 'resetar', '', 'Resetar', '');
//  $form->render();

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

    <div id="conteudo">

<?php
  $form->display();
?>

    </div>

  </div>

</body>
</html>