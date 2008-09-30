<?php

  // acho melhor fazer um question�rio est�tico para come�ar, porque fazer um din�mico � muito mais complicado

  include('rotinas.php');

  conectar();

  selecionar_banco('cursinho');

//  $resultado = query('SELECT * FROM questionario');

  printf("<pre>");
  print_r($_POST);
  printf("</pre>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
  <title>Cursinho comunit�rio da UFSCar</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" type="text/css" href="estilo.css" />
<!--  <script language="javascript" type="text/javascript" src="scripts.js"></script>
  <script language="javascript" type="text/javascript" src="ajax.js"></script>-->
</head>
<body>

  <div id="wrapper">

    <form id="frmQuestionario" name="frmQuestionario" method="post" action="index.php">

      <label for="txt"></label><input id="txt" name="txt" type="text" value="" maxlength="" /><br />
      <label for="rad"></label><input id="rad" name="rad" type="radio" value="" /><br />
      <label for="chk"></label><input id="chk" name="chk" type="checkbox" value="" /><br />

      <input id="radteste1" name="radteste" type="radio" value="teste1" checked="true" /><label for="radteste1">Teste1</label><br />
      <input id="radteste2" name="radteste" type="radio" value="teste2" /><label for="radteste2">Teste2</label><br />

      <input id="chkteste1" name="chkteste1" type="checkbox" value="uhum" /><label for="chkteste1">Teste1</label><br />
      <input id="chkteste2" name="chkteste2" type="checkbox" value="uhum2" checked="true" /><label for="chkteste2">Teste2</label><br />

      <label for="selTeste">Selecione</label>
      <select id="selTeste" name="selTeste">
        <option value="teste1">Teste 1</option>
        <option value="teste2" selected="true">Teste 2</option>
        <option value="teste3">Teste 3</option>
      </select>

      <h2>Dados pessoais</h2>
      <label for="txtNome_turma">Nome da turma</label><input id="txtNome_turma" name="txtNome_turma" type="text" value="" size="30" maxlength="255" /><br />
      <label for="txtNumero_inscricao">N�mero de inscri��o</label><input id="txtNumero_inscricao" name="txtNumero_inscricao" type="text" value="este campo � gerado automaticamente ou inserido pelo cadastrante?" size="6" maxlength="6" /><br />
      <label for="txtNome">Nome</label><input id="txtNome" name="txtNome" type="text" value="" maxlength="100" /><br />
      <label for="txtData_nascimento">Data de nascimento</label><input id="txtData_nascimento" name="txtData_nascimento" type="text" value="__/__/____" maxlength="10" /><br />
      <label for="txtEndereco">Endere�o</label><input id="txtEndereco" name="txtEndereco" type="text" value="" maxlength="" /><br />
      <label for="txtBairro">Bairro</label><input id="txtBairro" name="txtBairro" type="text" value="" maxlength="" />
      <label for="txtCidade">Cidade</label><input id="txtCidade" name="txtCidade" type="text" value="" maxlength="" />
      <label for="txtCep">CEP</label><input id="txtCep" name="txtCep" type="text" value="" maxlength="" /><br />
      <label for="txtTel_residencial">Tel. residencial</label><input id="txtTel_residencial" name="txtTel_residencial" type="text" value="" maxlength="" />
      <label for="txtTel_outro">Outro tel.</label><input id="txtTel_outro" name="txtTel_outro" type="text" value="" maxlength="" />
      <label for="txtEmail">E-mail</label><input id="txtEmail" name="txtEmail" type="text" value="" maxlength="" /><br />

      <label for="txtRg">RG</label><input id="txtRg" name="txtRg" type="text" value="" maxlength="" />
      <label for="txtOrgao_emissor">�rg�o emissor</label><input id="txtOrgao_emissor" name="txtOrgao_emissor" type="text" value="" maxlength="" /><br />
      <label for="txtCpf">CPF</label><input id="txtCpf" name="txtCpf" type="text" value="" maxlength="" /><br />
      <label for="txtAno_conclusao">Ano de conclus�o do ensino m�dio</label><input id="txtAno_conclusao" name="txtAno_conclusao" type="text" value="" maxlength="" /><br />
      Dados banc�rios<br/>
      <label for="txtBanco">Banco</label><input id="txtBanco" name="txtBanco" type="text" value="" maxlength="" />
      <label for="txtAgencia">Ag�ncia</label><input id="txtAgencia" name="txtAgencia" type="text" value="" maxlength="" />
      <label for="txtConta_corrente">Conta corrente</label><input id="txtConta_corrente" name="txtConta_corrente" type="text" value="" maxlength="" /><br />
      <label for="txtNome_mae">Nome da m�e</label><input id="txtNome_mae" name="txtNome_mae" type="text" value="" maxlength="" /><br />
      <label for="txtNome_pai">Nome do pai</label><input id="txtNome_pai" name="txtNome_pai" type="text" value="" maxlength="" /><br />

      <label for="txtProblemas_saude">Problemas de sa�de</label><input id="txtProblemas_saude" name="txtProblemas_saude" type="text" value="" maxlength="" /><br />
      <label for="txtTipo_transporte">Tipo de transporte</label><input id="txtTipo_transporte" name="txtTipo_transporte" type="text" value="" maxlength="" /><br />
      <label for="txt">Linha</label><input id="txt" name="txt" type="text" value="" maxlength="" /><br />
      <label for="txt">Hor�rio</label><input id="txt" name="txt" type="text" value="" maxlength="" /><br />
      <label for="txt">Linha</label><input id="txt" name="txt" type="text" value="" maxlength="" /><br />
      <label for="txt">Hor�rio</label><input id="txt" name="txt" type="text" value="" maxlength="" /><br />
      <label for="txtLocal_trabalho">Local de trabalho</label><input id="txtLocal_trabalho" name="txtLocal_trabalho" type="text" value="" maxlength="" /><br />
      <label for="txtEndereco_trabalho">Endere�o</label><input id="txtEndereco_trabalho" name="txtEndereco_trabalho" type="text" value="" maxlength="" /><br />
      <label for="txtTrabalha_sabados">Trabalha aos s�bados?</label><input id="txtTrabalha_sabados" name="txtTrabalha_sabados" type="text" value="" maxlength="" />
      <label for="txtHorario">Hor�rio</label><input id="txtHorario" name="txtHorario" type="text" value="" maxlength="" /><br />

      <label for="txtObservacoes">Observa��es</label><input id="txtObservacoes" name="txtObservacoes" type="text" value="" maxlength="" /><br />

      Tabela

      <input type="submit"></input>

    </form>

  </div>

</body>
</html>
<?php
  desconectar();
?>