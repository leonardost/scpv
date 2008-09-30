<?php

  session_start();

  if (!$_SESSION['logado']) {
    header('Location: index.php');
    exit();
  }

  include('view.php');

  $form = new Form('control/aluno.php', 'POST');
  $form->createElement('text', 'numero_inscricao', 'numero_inscricao|!', array('label' => 'Número de inscrição', 'maxlenght' => 10, 'class' => 'curto'), $_SESSION['aluno']['numero_inscricao']);
  $form->createElement('password', 'senha', 'senha|!', array('label' => 'Senha', 'maxlenght' => 100, 'class' => 'curto'), $_SESSION['aluno']['senha']);
  $form->createElement('radio', 'coisas', 'coisas', array('label' => 'TV', 'checked' => 'true'), '');
  $form->createElement('submit', 'enviar', 'enviar', '' , 'Enviar', '');
  $form->createElement('reset', 'resetar', 'resetar', '', 'Resetar', '');
  $form->render();

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

<?php write_header() ?>

    <div id="menu">
<?php write_menu(); ?>
      <div>
        <p>Logado como <?php echo $_SESSION['login'] ?> - <a href="control/login.php?action=logout">sair</a></p>
      </div>
    </div>

    <div id="conteudo">

<?php

  if (!isset($_GET['action'])) {
    printf("      <h1>Alunos</h1>\n");
  }
  else if ($_GET['action'] == 'cadastro') {

// --------------------------------------------------------
// CADASTRO
// --------------------------------------------------------

    if ($_SESSION['sucesso'] == true) {
      $_SESSION['sucesso'] = false;
?>
      <h3>Cadastro efetuado com sucesso!</h3>
      <a href="">(ícone de impressora) Imprimir comprovante e recibo</a>

<?php
    }
?>

<!-- repopular o formulário em caso de erro com volta a esta página -->

      <h2>Cadastro de alunos</h2>

      <form id="frmCadastro" name="frmCadastro" method="post" action="control/aluno.php">
        <label for="txtNumero_inscricao">Número de inscrição</label><input id="txtNumero_inscricao" name="numero_inscricao|!" type="text" value="" maxlength="10" class="curto" /><br />
<?php if ($_SESSION['erros']['numero_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Número de inscrição não preenchido</p>"); ?>
        <label for="txtAno">Ano</label><input id="txtAno" name="ano|!#" type="text" value="<?php echo date(Y); ?>" size="5" maxlength="4" class="curto" /><br />
<?php if ($_SESSION['erros']['ano']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano não preenchido</p>"); ?>
        <label for="txtNome">Nome</label><input id="txtNome" name="nome|!" type="text" value="" size="50" maxlength="100" /><br />
<?php if ($_SESSION['erros']['nome']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Nome não preenchido</p>"); ?>
        <label for="txtRg">RG</label><input id="txtRg" name="rg" type="text" value="" size="20" maxlength="20" class="curto" /><br />
        <label for="txtOrgao">Órgão emissor</label><input id="txtOrgao" name="rg_orgao_emissor" type="text" value="" size="6" maxlength="6" class="curto" /><br />
        <label for="txtCpf">CPF</label><input id="txtCpf" name="cpf" type="text" value="" size="13" maxlength="14" class="curto" /><br />
        <label for="txtNome_mae">Nome da mãe (completo)</label><input id="txtNome_mae" name="nome_mae" type="text" value="" size="30" maxlength="100" /><br />
        <label for="txtNome_pai">Nome do pai (completo)</label><input id="txtNome_pai" name="nome_pai" type="text" value="" size="30" maxlength="100" /><br />
        <label for="txtEndereco">Endereço do candidato</label><input id="txtEndereco" name="endereco" type="text" value="" size="50" maxlength="255" /><br />
<?php if ($_SESSION['erros']['endereco']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Endereço não preenchido</p>"); ?>
        <label for="txtBairro">Bairro</label><input id="txtBairro" name="bairro" type="text" value="" size="20" maxlength="255" /><br />
        <label for="txtCidade">Cidade</label><input id="txtCidade" name="cidade" type="text" value="" size="20" maxlength="255" /><br />
<?php if ($_SESSION['erros']['cidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Cidade não preenchido</p>"); ?>
        <label for="txtCep">CEP</label><input id="txtCep" name="cep" type="text" value="" size="8" maxlength="9" class="curto" /><br />
        <label for="txtTel_residencial">Telefone residencial</label><input id="txtTel_residencial" name="telefone_residencial" type="text" value="" size="13" maxlength="13" /><br />
        <label for="txtTel_outro">Outro telefone</label><input id="txtTel_outro" name="telefone_outro" type="text" value="" size="13" maxlength="13" /><br />
        <label for="txtAno_conclusao">Ano de conclusão do ensino médio</label><input id="txtAno_conclusao" name="ano_conclusao" type="text" value="" size="6" maxlength="4" class="curto" /><br />
<?php if ($_SESSION['erros']['ano_conclusao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano de conclusão não preenchido</p>"); ?>
        <label>Taxa de inscrição</label>
        <input id="radPaga" name="taxa_inscricao" type="radio" value="pg" class="radio" /><label for="radPaga" class="radio">Paga</label>
        <input id="radNaopaga" name="taxa_inscricao" type="radio" value="npg" class="radio" /><label for="radNaopaga" class="radio">Não paga</label>
        <br />
        <label>Opção de curso</label>
        <input id="radUm" name="opcao_curso" type="radio" value="1" class="radio" /><label for="radUm" class="radio">1 ano</label>
        <input id="radDois" name="opcao_curso" type="radio" value="2" class="radio" /><label for="radDois" class="radio">2 anos</label>
        <br />
        <label>Unidade</label>
        <input id="radAt5" name="unidade" type="radio" value="at5" class="radio" /><label for="radAt5" class="radio">AT5</label>
        <input id="radCidadearacy" name="unidade" type="radio" value="aracy" class="radio" /><label for="radCidadearacy" class="radio">Cidade Aracy</label>
        <br />
        <label>Pagamento da matrícula</label>
        <input id="radMatpaga" name="pagamento_matricula" type="radio" value="pg" class="radio" /><label for="radMatpaga" class="radio">Paga</label>
        <input id="radMatnaopaga" name="pagamento_matricula" type="radio" value="npg" class="radio" /><label for="radMatnaopaga" class="radio">Não paga</label>
        <br />
        <label></label>
        <input id="btnCadastrar" name="cadastrar" type="submit" value="Cadastrar" class="botao" />
        <input id="btnCancelar" name="cancelar" type="reset" value="Cancelar" class="botao" /><br />
        <input id="hidAcao" name="acao" type="hidden" value="cadastro" /><br />
      </form>

<?php
  }
  else if ($_GET['action'] == 'questionario') {

// --------------------------------------------------------
// QUESTIONÁRIO
// --------------------------------------------------------



  }
  else if ($_GET['action'] == 'consulta') {

// --------------------------------------------------------
// CONSULTA
// --------------------------------------------------------

?>

      <h2>Consulta de alunos</h2>

      <form id="frmConsulta">
        <p>Pesquisar por</p><br />
        <label for="txtNum_inscr">N &ordm; de inscrição</label><input name="numero" type="text" value="" /><br />
        <label for="txtNome">Nome : </label><input name="nome" type="text" value="" /><br />
        <p>Etnia</p>
        <input id="radAfrodescendente" name="etnia" type="radio" value="afrodescendente" class="radio" /><label for="radAfrodescendente" class="radio">Afrodescendente</label>
        <input id="radBranco" name="etnia" type="radio" value="branco" class="radio" /><label for="radBranco" class="radio">Branco</label>
        <input id="radIndigena" name="etnia" type="radio" value="indigena" class="radio" /><label for="radIndigena" class="radio">Indígena</label>
        <input id="radOriental" name="etnia" type="radio" value="oriental" class="radio" /><label for="radOriental" class="radio">Oriental</label>
        <br />
        <p>Cor</p>
        <input id="radPreto" name="cor" type="radio" value="preto" class="radio" /><label for="radPreto" class="radio">Preto</label>
        <input id="radPardo" name="cor" type="radio" value="pardo" class="radio" /><label for="radPardo" class="radio">Pardo</label>
        <input id="radAmarelo" name="cor" type="radio" value="amarelo" class="radio" /><label for="radAmarelo" class="radio">Amarelo</label>
        <input id="radBrancoCor" name="cor" type="radio" value="branco" class="radio" /><label for="radBrancoCor" class="radio">Branco</label>
        <br />
        <p>Unidade</p>
        <input id="radAt5" name="unidade" type="radio" value="at5" class="radio" /><label for="radAt5" class="radio">AT5</label>
        <input id="radAracy" name="unidade" type="radio" value="aracy" class="radio" /><label for="radAracy" class="radio">Cidade Aracy</label>
        <br />
        <input name="pesquisar" type="submit" value="Pesquisar" />
        <input name="resetar" type="reset" value="Resetar" />
        <br />
      </form>

      <br /><br />

      <h3>Listagem de todos os alunos</h3><br />

<?php

    if ($_SESSION['num_alunos'] == 0)
      printf("      Não existem alunos cadastrados\n");
    else {
      printf("      <table>\n");
      printf("        <tr><th class=\"vazio\"></th><th class=\"vazio\"></td><th class=\"numero\">N &ordm;</th><th class=\"nome\">Nome</th><th class=\"etc\">Questionário</th></tr>\n");
      $classe = '';
      for ($i = 0; $i < $_SESSION['num_alunos']; ++$i) {
        $aluno = $_SESSION['alunos'][$i];
        printf("        <tr".$classe."><td><a href=\"control/aluno.php?action=consulta_aluno&numero_inscricao=%d&ano=%d\"><img src=\"imagens/lupa2.png\" alt=\"Consultar aluno\" title=\"Consultar aluno\"/></a></td><td><a href=\"control/aluno.php?action=editar&numero_inscricao=%d&ano=%d\"><img src=\"imagens/editar.png\" alt=\"Editar\" title=\"Editar\"/></a></td><td class=\"numero\">%d</td><td>%s</td><td>%s</td></tr>\n", $aluno['numero_inscricao'], $aluno['ano'], $aluno['numero_inscricao'], $aluno['ano'], $aluno['numero_inscricao'], $aluno['nome'], $aluno['questionario']);
        if ($classe == '')
          $classe = ' class="alt"';
        else
          $classe = '';
      }
      printf("      </table>\n");
    }

  }
  else if ($_GET['action'] == 'consulta_aluno') {

// --------------------------------------------------------
// CONSULTA DE ALUNO ESPECÍFICO
// --------------------------------------------------------

?>
    <!-- Acho que seria melhor fazer isto aqui como uma tabela -->

    <p class="coluna">Número de inscrição </p><p class="coluna2"><?php echo $_SESSION['aluno']['numero_inscricao'] ?></p><br />
    <p class="coluna">Ano </p><p class="coluna2"><?php echo $_SESSION['aluno']['ano'] ?></p><br />

    <p><a href="control/aluno.php?action=editar&numero_inscricao=<?php echo $_SESSION['aluno']['numero_inscricao'] ?>&ano=<?php echo $_SESSION['aluno']['ano'] ?>">Alterar os dados deste aluno</a></p><br />

    <p class="coluna">Nome </p><p class="coluna2"><?php echo $_SESSION['aluno']['nome'] ?></p><br />
    <p class="coluna">Sexo </p><p class="coluna2"><?php echo $_SESSION['aluno']['sexo'] ?></p><br />
    <p class="coluna">Data de nascimento </p><p class="coluna2"><?php echo $_SESSION['aluno']['data'] ?></p><br />
    <p class="coluna">Cor </p><p class="coluna2"><?php echo $_SESSION['aluno']['cor'] ?></p><br />
    <p class="coluna">Etnia </p><p class="coluna2"><?php echo $_SESSION['aluno']['etnia'] ?></p><br />
    <p class="coluna">Endereco </p><p class="coluna2"><?php echo $_SESSION['aluno']['endereco'] ?></p><br />
    <p class="coluna">Complemento </p><p class="coluna2"><?php echo $_SESSION['aluno']['complemento'] ?></p><br />
    <p class="coluna">Bairro </p><p class="coluna2"><?php echo $_SESSION['aluno']['bairro'] ?></p><br />
    <p class="coluna">Cidade </p><p class="coluna2"><?php echo $_SESSION['aluno']['cidade'] ?></p><br />
    <p class="coluna">CEP </p><p class="coluna2"><?php echo $_SESSION['aluno']['cep'] ?></p><br />
    <p class="coluna">Telefone residencial </p><p class="coluna2"><?php echo $_SESSION['aluno']['telefone_residencial'] ?></p><br />
    <p class="coluna">Outro telefone </p><p class="coluna2"><?php echo $_SESSION['aluno']['telefone_outro'] ?></p><br />
    <p class="coluna">E-mail </p><p class="coluna2"><?php echo $_SESSION['aluno']['email'] ?></p><br />
    <p class="coluna">RG </p><p class="coluna2"><?php echo $_SESSION['aluno']['rg'] ?></p><br />
    <p class="coluna">Órgao emissor </p><p class="coluna2"><?php echo $_SESSION['aluno']['rg_orgao_emissor'] ?></p><br />
    <p class="coluna">CPF </p><p class="coluna2"><?php echo $_SESSION['aluno']['cpf'] ?></p><br />
    <p class="coluna">Ano de conclusão do ensino médio </p><p class="coluna2"><?php echo $_SESSION['aluno']['ano_conclusao'] ?></p><br />
    <p class="coluna">Nome da mãe </p><p class="coluna2"><?php echo $_SESSION['aluno']['nome_mae'] ?></p><br />
    <p class="coluna">Nome do pai </p><p class="coluna2"><?php echo $_SESSION['aluno']['nome_pai'] ?></p><br />
    <p class="coluna">Observações </p><p class="coluna2"><?php echo $_SESSION['aluno']['observacoes'] ?></p><br />
    <p class="coluna">Trabalho </p><p class="coluna2"><?php echo $_SESSION['aluno']['trabalho'] ?></p><br />
    <p class="coluna">Taxa de inscrição </p><p class="coluna2"><?php echo $_SESSION['aluno']['taxa_inscricao'] ?></p><br />
    <p class="coluna">Opção de curso </p><p class="coluna2"><?php echo $_SESSION['aluno']['opcao_curso'] ?></p><br />
    <p class="coluna">Questionario </p><p class="coluna2"><?php echo $_SESSION['aluno']['questionario'] ?></p><br />
    <p class="coluna">Prova </p><p class="coluna2"><?php echo $_SESSION['aluno']['prova'] ?></p><br />
    <p class="coluna">Foto </p><p class="coluna2"><?php echo $_SESSION['aluno']['foto'] ?></p><br />
    <p class="coluna">Matricula </p><p class="coluna2"><?php echo $_SESSION['aluno']['matricula'] ?></p><br />
    <p class="coluna">Pagamento da matricula </p><p class="coluna2"><?php echo $_SESSION['aluno']['pagamento_matricula'] ?></p><br />
    <p class="coluna">Mensalidade </p><p class="coluna2"><?php echo $_SESSION['aluno']['mensalidade'] ?></p><br />
    <p class="coluna">Sala </p><p class="coluna2"><?php echo $_SESSION['aluno']['sala'] ?></p><br />
    <p class="coluna">Convocado </p><p class="coluna2"><?php echo $_SESSION['aluno']['convocado'] ?></p><br />

<?php
  }
  else if ($_GET['action'] == 'editar') {

// --------------------------------------------------------
// ALTERAR
// --------------------------------------------------------
?>

      <h2>Alterar informações</h2>

      <form id="frmAlterar" name="frmAlterar" method="post" action="control/aluno.php">
        <label for="txtNumero_inscricao">Número de inscrição</label><input id="txtNumero_inscricao" name="numero_inscricao|!" type="text" value="<?php echo $_SESSION['aluno']['numero_inscricao'] ?>" size="10" maxlength="10" /><br />
<?php if ($_SESSION['erros']['numero_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Número de inscrição não preenchido</p>"); ?>
        <label for="txtAno">Ano</label><input id="txtAno" name="ano|!#" type="text" value="<?php echo $_SESSION['aluno']['ano'] ?>" size="5" maxlength="4" /><br />
<?php if ($_SESSION['erros']['ano']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano não preenchido</p>"); ?>
        <label for="txtNome">Nome</label><input id="txtNome" name="nome|!" type="text" value="<?php echo $_SESSION['aluno']['nome'] ?>" size="30" maxlength="100" /><br />
<?php if ($_SESSION['erros']['nome']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Nome não preenchido</p>"); ?>
        <label for="txtRg">RG</label><input id="txtRg" name="rg" type="text" value="<?php echo $_SESSION['aluno']['rg'] ?>" size="20" maxlength="20" /><br />
        <label for="txtOrgao">Órgão emissor</label><input id="txtOrgao" name="rg_orgao_emissor" type="text" value="<?php echo $_SESSION['aluno']['rg_orgao_emissor'] ?>" size="6" maxlength="6" /><br />
        <label for="txtCpf">CPF</label><input id="txtCpf" name="cpf" type="text" value="<?php echo $_SESSION['aluno']['cpf'] ?>" size="13" maxlength="14" /><br />
        <label for="txtNome_mae">Nome da mãe (completo)</label><input id="txtNome_mae" name="nome_mae" type="text" value="<?php echo $_SESSION['aluno']['nome_mae'] ?>" size="30" maxlength="100" /><br />
        <label for="txtNome_pai">Nome do pai (completo)</label><input id="txtNome_pai" name="nome_pai" type="text" value="<?php echo $_SESSION['aluno']['nome_pai'] ?>" size="30" maxlength="100" /><br />
        <label for="txtEndereco">Endereço do candidato</label><input id="txtEndereco" name="endereco" type="text" value="<?php echo $_SESSION['aluno']['endereco'] ?>" size="50" maxlength="255" /><br />
<?php if ($_SESSION['erros']['endereco']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Endereço não preenchido</p>"); ?>
        <label for="txtBairro">Bairro</label><input id="txtBairro" name="bairro" type="text" value="<?php echo $_SESSION['aluno']['bairro'] ?>" size="20" maxlength="255" /><br />
        <label for="txtCidade">Cidade</label><input id="txtCidade" name="cidade" type="text" value="<?php echo $_SESSION['aluno']['cidade'] ?>" size="20" maxlength="255" /><br />
<?php if ($_SESSION['erros']['cidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Cidade não preenchido</p>"); ?>
        <label for="txtCep">CEP</label><input id="txtCep" name="cep" type="text" value="<?php echo $_SESSION['aluno']['cep'] ?>" size="8" maxlength="9" /><br />
        <label for="txtTel_residencial">Telefone residencial</label><input id="txtTel_residencial" name="telefone_residencial" type="text" value="<?php echo $_SESSION['aluno']['telefone_residencial'] ?>" size="13" maxlength="13" /><br />
        <label for="txtTel_outro">Outro telefone</label><input id="txtTel_outro" name="telefone_outro" type="text" value="<?php echo $_SESSION['aluno']['telefone_outro'] ?>" size="13" maxlength="13" /><br />
        <label for="txtAno_conclusao">Ano de conclusão do ensino médio</label><input id="txtAno_conclusao" name="ano_conclusao" type="text" value="<?php echo $_SESSION['aluno']['ano_conclusao'] ?>" size="6" maxlength="4" /><br />
<?php if ($_SESSION['erros']['ano_conclusao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano de conclusão não preenchido</p>"); ?>
        <label>Taxa de inscrição</label>
        <input id="radPaga" name="taxa_inscricao" type="radio" value="pg" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') echo "checked=\"true\" " ?>/><label for="radPaga">Paga</label>
        <input id="radNaopaga" name="taxa_inscricao" type="radio" value="npg" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'npg') echo "checked=\"true\" " ?>/><label for="radNaopaga">Não paga</label>
        <br />
        <label>Opção de curso</label>
        <input id="radUm" name="opcao_curso" type="radio" value="1" <?php if ($_SESSION['aluno']['opcao_curso'] == '1') echo "checked=\"true\" " ?>/><label for="radUm">1 ano</label>
        <input id="radDois" name="opcao_curso" type="radio" value="2" <?php if ($_SESSION['aluno']['opcao_curso'] == '2') echo "checked=\"true\" " ?>/><label for="radDois">2 anos</label>
        <br />
        <label>Unidade</label>
        <input id="radAt5" name="unidade" type="radio" value="at5" <?php if ($_SESSION['aluno']['unidade'] == 'at5') echo "checked=\"true\" " ?>/><label for="radAt5">AT5</label>
        <input id="radCidadearacy" name="unidade" type="radio" value="aracy" <?php if ($_SESSION['aluno']['unidade'] == 'aracy') echo "checked=\"true\" " ?>/><label for="radCidadearacy">Cidade Aracy</label>
        <br />
        <label>Pagamento da matrícula</label>
        <input id="radMatpaga" name="pagamento_matricula" type="radio" value="pg" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') echo "checked=\"true\" " ?>/><label for="radMatpaga">Paga</label>
        <input id="radMatnaopaga" name="pagamento_matricula" type="radio" value="npg" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'npg') echo "checked=\"true\" " ?>/><label for="radMatnaopaga">Não paga</label>
        <br />
        <input id="btnCadastrar" name="alterar" type="submit" value="Alterar" />
        <input id="btnCancelar" name="cancelar" type="reset" value="Cancelar" /><br />
        <input id="hidAcao" name="acao" type="hidden" value="alterar" /><br />
      </form>

<?php
  }
?>

    </div>

<?php write_footer() ?>

  </div>

</body>
</html>