<?php

  include('control/alunocontrol.php');
  include('view.php');

  $a = new AlunoControl();

  write_upper();

  write_header();

  write_menu();

?>

<?php

  if (!isset($_GET['action'])) {

?>

      <h1>Alunos</h1>
  
      <h3>Opções:</h3><br />
      <ul>
        <li><a href="alunos.php?action=cadastro">Cadastrar novo aluno</a></li>
        <li><a href="alunos.php?action=consulta">Consultar alunos</a></li>
        <li><a href="alunos.php?action=listagem">Listar todos os alunos</a></li>
      </ul>

<?php
  }
  else if ($_GET['action'] == 'sucesso') {
    if ($_SESSION['cadastro_sucesso']) {
      unset($_SESSION['cadastro_sucesso']);
      $link = 'alunos.php?action=imprimir&numero_inscricao='.$_SESSION['aluno']['numero_inscricao'].'&ano='.$_SESSION['aluno']['ano'];

// IDÉIA
// poderíamos guardar na sessão, ao invés do numero e ano, o link feito para colocar no local certo (numero_inscricao=x&ano=y)
//

?>
      <h2>Cadastro efetuado com sucesso!</h2>
      <a href="<?php echo $link ?>"><img src="imagens/pdf.gif" /> Gerar comprovante e recibo</a><br /><br />
      <a href="alunos.php?action=editar&numero_inscricao=<?php echo $_SESSION['aluno']['numero_inscricao'] ?>&ano=<?php echo $_SESSION['aluno']['ano'] ?>"><img src="imagens/editar.png" /> Editar informações do aluno</a><br /><br />
      <a href="alunos.php?action=cadastro"><img src="imagens/document.gif" /> Cadastrar outro aluno</a>

<?php
    }
    else if ($_SESSION['alteracao_sucesso']) {
      unset($_SESSION['alteracao_sucesso']);
?>
      <h2>Alteração efetuada com sucesso!</h2>
      <a href="alunos.php?action=consulta"><img src="imagens/lupa.png" /> Consultar outro aluno</a><br /><br />
      <a href="alunos.php?action=listagem"><img src="imagens/lista.gif" /> Voltar para listagem de alunos</a>
<?php
    }

  }
  else if ($_GET['action'] == 'cadastro') {

    // --------------------------------------------------------
    // CADASTRO
    // --------------------------------------------------------

?>

      <h2>Cadastro de alunos</h2>

      <form id="frmCadastro" name="frmCadastro" method="post" action="alunos.php">
        <label for="txtNumero_inscricao">Número de inscrição</label><input id="txtNumero_inscricao" name="numero_inscricao|!#" type="text" value="<?php echo $_SESSION['aluno']['numero_inscricao'] ?>" maxlength="10" style="width:80px" /><br />
<?php if ($_SESSION['erros']['numero_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Número de inscrição não preenchido</p><br />"); ?>
<?php if ($_SESSION['erros']['numero_inscricao']['JA_EXISTE']) printf("<p class=\"erro\">Este número de inscrição e ano já estão cadastrados no sistema</p><br />"); ?>
        <label for="txtAno">Ano</label><input id="txtAno" name="ano|!#" type="text" value="<?php if ($_SESSION['aluno']['ano'] != '') echo $_SESSION['aluno']['ano']; else echo date(Y); ?>" maxlength="4" style="width:35px" /><br />
<?php if ($_SESSION['erros']['ano']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano não preenchido</p><br />"); ?>
<?php if ($_SESSION['erros']['ano']['JA_EXISTE']) printf("<p class=\"erro\">Este número de inscrição e ano já estão cadastrados no sistema</p><br />"); ?>
        <label for="txtNome">Nome</label><input id="txtNome" name="nome|!" type="text" value="<?php echo $_SESSION['aluno']['nome'] ?>" maxlength="100" /><br />
<?php if ($_SESSION['erros']['nome']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Nome não preenchido</p><br />"); ?>
        <label for="txtRg">RG</label><input id="txtRg" name="rg" type="text" value="<?php echo $_SESSION['aluno']['rg'] ?>" maxlength="20" style="width:90px" /><br />
        <label for="txtOrgao">Órgão emissor</label><input id="txtOrgao" name="rg_orgao_emissor" type="text" value="<?php echo $_SESSION['aluno']['rg_orgao_emissor'] ?>" maxlength="6" style="width:80px" /><br />
        <label for="txtCpf">CPF</label><input id="txtCpf" name="cpf" type="text" value="<?php echo $_SESSION['aluno']['cpf'] ?>" maxlength="14" style="width:110px" /><br />
        <label for="txtNome_mae">Nome da mãe</label><input id="txtNome_mae" name="nome_mae" type="text" value="<?php echo $_SESSION['aluno']['nome_mae'] ?>" maxlength="100" /><br />
        <label for="txtNome_pai">Nome do pai</label><input id="txtNome_pai" name="nome_pai" type="text" value="<?php echo $_SESSION['aluno']['nome_pai'] ?>" maxlength="100" /><br />
        <label for="txtEndereco">Endereço</label><input id="txtEndereco" name="endereco" type="text" value="<?php echo $_SESSION['aluno']['endereco'] ?>" maxlength="255" /><br />
<?php // if ($_SESSION['erros']['endereco']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Endereço não preenchido</p><br />"); ?>
        <label for="txtNumero">Número</label><input id="txtNumero" name="numero" type="text" value="<?php echo $_SESSION['aluno']['numero'] ?>" maxlength="50" style="width:80px" /><br />
        <label for="txtComplemento">Complemento</label><input id="txtComplemento" name="complemento" type="text" value="<?php echo $_SESSION['aluno']['complemento'] ?>" maxlength="255" /><br />
        <label for="txtBairro">Bairro</label><input id="txtBairro" name="bairro" type="text" value="<?php echo $_SESSION['aluno']['bairro'] ?>" maxlength="255" /><br />
        <label for="txtCidade">Cidade</label><input id="txtCidade" name="cidade" type="text" value="<?php echo $_SESSION['aluno']['cidade'] ?>" maxlength="255" /><br />
<?php // if ($_SESSION['erros']['cidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Cidade não preenchido</p><br />"); ?>
        <label for="txtCep">CEP</label><input id="txtCep" name="cep" type="text" value="<?php echo $_SESSION['aluno']['cep'] ?>" maxlength="9" style="width:70px" /><br />
        <label for="txtTel_residencial">Telefone residencial</label><input id="txtTel_residencial" name="telefone_residencial" type="text" value="<?php echo $_SESSION['aluno']['telefone_residencial'] ?>" maxlength="13" style="width:100px" /><br />
        <label for="txtTel_outro">Outro telefone</label><input id="txtTel_outro" name="telefone_outro" type="text" value="<?php echo $_SESSION['aluno']['telefone_outro'] ?>" maxlength="13" style="width:100px" /><br />
        <label for="txtAno_conclusao">Ano de conclusão do ensino médio</label><input id="txtAno_conclusao" name="ano_conclusao|#" type="text" value="<?php echo $_SESSION['aluno']['ano_conclusao'] ?>" maxlength="4" style="width:35px" /><br />
<?php if ($_SESSION['erros']['ano_conclusao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano de conclusão não preenchido</p><br />"); ?>
        <label>Taxa de inscrição</label>
        <input id="radPaga" name="taxa_inscricao" type="radio" value="pg" class="radio" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') echo "checked=\"true\" " ?>/><label for="radPaga" class="radio">Paga</label>
        <input id="radNaopaga" name="taxa_inscricao" type="radio" value="npg" class="radio" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'npg') echo "checked=\"true\" " ?>/><label for="radNaopaga" class="radio">Não paga</label>
        <br />
<?php if ($_SESSION['erros']['taxa_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Taxa de inscrição não selecionada!</p><br />"); ?>
        <label>Opção de curso</label>
        <input id="radUm" name="opcao_curso" type="radio" value="1" class="radio" <?php if ($_SESSION['aluno']['opcao_curso'] == '1') echo "checked=\"true\" " ?>/><label for="radUm" class="radio">1 ano</label>
        <input id="radDois" name="opcao_curso" type="radio" value="2" class="radio" <?php if ($_SESSION['aluno']['opcao_curso'] == '2') echo "checked=\"true\" " ?>/><label for="radDois" class="radio">2 anos</label>
        <br />
<?php if ($_SESSION['erros']['opcao_curso']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Opção de curso não selecionada!</p><br />"); ?>
        <label>Unidade</label>
        <input id="radAt5" name="unidade" type="radio" value="at5" class="radio" <?php if ($_SESSION['aluno']['unidade'] == 'at5') echo "checked=\"true\" "?>/><label for="radAt5" class="radio">AT5</label>
        <input id="radCidadearacy" name="unidade" type="radio" value="aracy" class="radio" <?php if ($_SESSION['aluno']['unidade'] == 'aracy') echo "checked=\"true\" "?>/><label for="radCidadearacy" class="radio">Cidade Aracy</label>
        <br />
<?php if ($_SESSION['erros']['unidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Unidade não selecionada!</p><br />"); ?>
        <label>Pagamento da matrícula</label>
        <input id="radMatpaga" name="pagamento_matricula" type="radio" value="pg" class="radio" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') echo "checked=\"true\" " ?>/><label for="radMatpaga" class="radio">Paga</label>
        <input id="radMatnaopaga" name="pagamento_matricula" type="radio" value="npg" class="radio" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'npg') echo "checked=\"true\" " ?>/><label for="radMatnaopaga" class="radio">Não paga</label>
        <br />
<?php if ($_SESSION['erros']['pagamento_matricula']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Pagamento de matrícula não selecionado!</p><br />"); ?>
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

?>

      <h2>Questionário sócio-econômico</h2>

      - Alunos que ainda não responderam
      - consultar ranking

<?
  }
  else if ($_GET['action'] == 'consulta') {

    // --------------------------------------------------------
    // CONSULTA
    // --------------------------------------------------------

    if ($_GET['listagem']) {

      if ($_SESSION['num_alunos'] > 0) {

        if (!isset($_GET['page'])) {
          $_GET['page'] = 0;
          $_GET['itens_pagina'] = 10;   // numero de itens por página
        }
        $itens_pagina = $_GET['itens_pagina'];  // fazer checagens de segurança e tal
        if (($_GET['page'] + 1) * $itens_pagina > $_SESSION['num_alunos']) {
          $limite_sup = $_SESSION['num_alunos'];
        }
        else {
          $limite_sup = ($_GET['page'] + 1) * $itens_pagina;
        }

        printf("      <h2>Consulta de alunos</h2>\n");
        printf("      <a href=\"alunos.php?action=consulta\"><img src=\"imagens/lupa.png\" /> Realizar outra consulta</a><br /><br />\n");
        printf("      <ul>\n");
        printf("        <li>Resultados: %d</li>", $_SESSION['num_alunos']);
        printf("        <li>Mostrando registros de %d a %d</li>", $_GET['page'] * 5 + 1, $limite_sup);
        printf("      </ul>\n");
        printf("      <br />\n");
        printf("      <table>\n");
        printf("        <tr><th class=\"vazio\"></th><th class=\"vazio\"></td><th class=\"numero\">N &ordm;</th><th class=\"ano\">Ano</th><th class=\"nome\">Nome</th><th class=\"questionario\">Questionário</th></tr>\n");
        $classe = '';
        for ($i = $_GET['page'] * $itens_pagina; $i < ($_GET['page'] + 1) * $itens_pagina && $i < $_SESSION['num_alunos']; ++$i) {

          $aluno = $_SESSION['alunos'][$i];
          if ($aluno['questionario'] == 'nok') {
            $questionario = '<a href="alunos.php?action=questionario&numero_inscricao='.$aluno['numero_inscricao'].'&ano='.$aluno['ano'].'">não preenchido</a>';
          }
          else {
            $questionario = 'preenchido';
          }
          printf("        <tr".$classe."><td><a href=\"alunos.php?action=consulta_aluno&numero_inscricao=%d&ano=%d\"><img src=\"imagens/lupa.png\" alt=\"Consultar aluno\" title=\"Consultar aluno\"/></a></td>
            <td><a href=\"alunos.php?action=editar&numero_inscricao=%d&ano=%d\"><img src=\"imagens/editar.png\" alt=\"Editar\" title=\"Editar\"/></a></td>
            <td class=\"numero\">%d</td><td class=\"ano\">%d</td><td>%s</td><td>%s</td></tr>\n",
            $aluno['numero_inscricao'], $aluno['ano'],
            $aluno['numero_inscricao'], $aluno['ano'],
            $aluno['numero_inscricao'], $aluno['ano'], $aluno['nome'], $questionario);
          if ($classe == '')
            $classe = ' class="alt"';
          else
            $classe = '';
        }
        printf("      </table><br />\n");
        printf("      <p>");
        if ($_GET['page'] > 0) {
          printf("<a href=\"alunos.php?action=consulta&listagem=true&page=%d&itens_pagina=%d\"><img src=\"imagens/seta_esq.gif\" alt=\"Página anterior\" title=\"Página anterior\" /></a> &nbsp; ", $_GET['page'] - 1, $_GET['itens_pagina']);
        }
        printf("Página atual : %d", $_GET['page'] + 1);
        if (($_GET['page'] + 1) * $itens_pagina < $_SESSION['num_alunos']) {
          printf(" &nbsp; <a href=\"alunos.php?action=consulta&listagem=true&page=%d&itens_pagina=%d\"><img src=\"imagens/seta_dir.gif\" alt=\"Próxima página\" title=\"Próxima página\" /></a>", $_GET['page'] + 1, $_GET['itens_pagina']);
        }
        printf("</p>");

      }
      else {

        printf("      <h3>Sua busca não trouxe nenhum resultado</h3><br />\n");
        printf("      <a href=\"alunos.php?action=consulta\">Realizar outra consulta</a><br /><br />\n");

      }

    }
    else {
?>

      <h2>Consulta de alunos</h2>

      <form id="frmConsulta" action="alunos.php" method="post">
        <h3>Pesquisar por</h3><br />
        <label for="txtNumero_inscricao">N &ordm; de inscrição</label><input id="txtNumero_inscricao" name="numero_inscricao|#" type="text" style="width:80px" /><br />
        <label for="txtAno">Ano</label><input id="txtAno" name="ano|#" type="text" value="" maxlength="4" style="width:35px" /><br />
        <label for="txtNome">Nome : </label><input name="nome" type="text" value="" /><br />
        <label for="txtRg">RG</label><input id="txtRg" name="rg" type="text" value="" maxlength="20" style="width:90px" /><br />
        <label for="txtOrgao">Órgão emissor</label><input id="txtOrgao" name="rg_orgao_emissor" type="text" value="" maxlength="6" style="width:80px" /><br />
        <label for="txtCpf">CPF</label><input id="txtCpf" name="cpf" type="text" value="" maxlength="14" style="width:110px" /><br />
        <label for="txtNome_mae">Nome da mãe (completo)</label><input id="txtNome_mae" name="nome_mae" type="text" value="" maxlength="100" /><br />
        <label for="txtNome_pai">Nome do pai (completo)</label><input id="txtNome_pai" name="nome_pai" type="text" value="" maxlength="100" /><br />
        <label for="txtEndereco">Endereço do candidato</label><input id="txtEndereco" name="endereco" type="text" value="" maxlength="255" /><br />
        <label for="txtNumero">Número</label><input id="txtNumero" name="numero" type="text" value="" maxlength="50" style="width:80px" /><br />
        <label for="txtComplemento">Complemento</label><input id="txtComplemento" name="complemento" type="text" value="" maxlength="255" /><br />
        <label for="txtBairro">Bairro</label><input id="txtBairro" name="bairro" type="text" value="" maxlength="255" /><br />
        <label for="txtCidade">Cidade</label><input id="txtCidade" name="cidade" type="text" value="" maxlength="255" /><br />
        <label for="txtCep">CEP</label><input id="txtCep" name="cep" type="text" value="" maxlength="9" style="width:70px" /><br />
        <label for="txtTel_residencial">Telefone residencial</label><input id="txtTel_residencial" name="telefone_residencial" type="text" value="" maxlength="13" style="width:100px" /><br />
        <label for="txtTel_outro">Outro telefone</label><input id="txtTel_outro" name="telefone_outro" type="text" value="" maxlength="13" style="width:100px" /><br />
        <label for="txtAno_conclusao">Ano de conclusão do ensino médio</label><input id="txtAno_conclusao" name="ano_conclusao|#" type="text" value="" maxlength="4" style="width:35px" /><br />
        <label>Questionário</label>
        <input id="radPreenchido" name="questionario" type="radio" value="ok" class="radio" /><label for="radPreenchido" class="radio">Preenchido</label>
        <input id="radNaopreenchido" name="questionario" type="radio" value="nok" class="radio" /><label for="radNaopreenchido" class="radio">Não preenchido</label>
        <br /><br />
        <label>Taxa de inscrição</label>
        <input id="radPaga" name="taxa_inscricao" type="radio" value="pg" class="radio" /><label for="radPaga" class="radio">Paga</label>
        <input id="radNaopaga" name="taxa_inscricao" type="radio" value="npg" class="radio" /><label for="radNaopaga" class="radio">Não paga</label>
        <br /><br />
        <label>Opção de curso</label>
        <input id="radUm" name="opcao_curso" type="radio" value="1" class="radio" /><label for="radUm" class="radio">1 ano</label>
        <input id="radDois" name="opcao_curso" type="radio" value="2" class="radio" /><label for="radDois" class="radio">2 anos</label>
        <br /><br />
        <label>Etnia</label>
        <input id="radAfrodescendente" name="etnia" type="radio" value="afrodescendente" class="radio" /><label for="radAfrodescendente" class="radio">Afrodescendente</label>
        <input id="radBranco" name="etnia" type="radio" value="branco" class="radio" /><label for="radBranco" class="radio">Branco</label><br />
        <label></label>
        <input id="radIndigena" name="etnia" type="radio" value="indigena" class="radio" /><label for="radIndigena" class="radio">Indígena</label>
        <input id="radOriental" name="etnia" type="radio" value="oriental" class="radio" /><label for="radOriental" class="radio">Oriental</label>
        <br /><br />
        <label>Cor</label>
        <input id="radPreto" name="cor" type="radio" value="preto" class="radio" /><label for="radPreto" class="radio">Preto</label>
        <input id="radPardo" name="cor" type="radio" value="pardo" class="radio" /><label for="radPardo" class="radio">Pardo</label><br />
        <label></label>
        <input id="radAmarelo" name="cor" type="radio" value="amarelo" class="radio" /><label for="radAmarelo" class="radio">Amarelo</label>
        <input id="radBrancoCor" name="cor" type="radio" value="branco" class="radio" /><label for="radBrancoCor" class="radio">Branco</label>
        <br /><br />
        <label>Unidade</label>
        <input id="radAt5" name="unidade" type="radio" value="at5" class="radio" /><label for="radAt5" class="radio">AT5</label>
        <input id="radCidadearacy" name="unidade" type="radio" class="radio" value="aracy" /><label for="radCidadearacy" class="radio">Cidade Aracy</label>
        <br /><br />
        <label>Pagamento da matrícula</label>
        <input id="radMatpaga" name="pagamento_matricula" type="radio" value="pg" class="radio" /><label for="radMatpaga" class="radio">Paga</label>
        <input id="radMatnaopaga" name="pagamento_matricula" type="radio" value="npg" class="radio" /><label for="radMatnaopaga" class="radio">Não paga</label>
        <br /><br />
        <label>Convocado</label>
        <input id="radConvocado" name="convocado" type="radio" value="s" class="radio" /><label for="radConvocado" class="radio">Sim</label>
        <input id="radNaoconvocado" name="convocado" type="radio" value="n" class="radio" /><label for="radNaoconvocado" class="radio">Não</label><br />
        <label></label>
        <input id="radIndefinido" name="convocado" type="radio" value="i" class="radio" /><label for="radIndefinido" class="radio">Indefinido</label>
        <br /><br />
        <label></label>
        <input name="pesquisar" type="submit" value="Pesquisar" class="botao" />
        <input name="resetar" type="reset" value="Resetar" class="botao" />
        <br />
      </form>

<?php
    }
  }
  else if ($_GET['action'] == 'consulta_aluno') {

    // --------------------------------------------------------
    // INFORMAÇÕES DE UM ALUNO ESPECÍFICO
    // --------------------------------------------------------

    $link = 'alunos.php?action=imprimir&numero_inscricao='.$_SESSION['aluno']['numero_inscricao'].'&ano='.$_SESSION['aluno']['ano'];
?>
    <!-- Acho que seria melhor fazer isto aqui como uma tabela -->

    <h2>Perfil do aluno</h2>

    <ul>
      <li><a href="alunos.php?action=editar&numero_inscricao=<?php echo $_SESSION['aluno']['numero_inscricao'] ?>&ano=<?php echo $_SESSION['aluno']['ano'] ?>"><img src="imagens/editar.png" /> Alterar os dados deste aluno</a></li>
      <li><a href="<?php echo $link ?>"><img src="imagens/pdf.gif" /> Gerar comprovante de matrícula</a></li>
<!--      <li><a href="alunos.php?action=listagem"><img src="imagens/lista.gif" /> Voltar à listagem de alunos</a></li>-->
    </ul>
    <br />

<?php

  if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') {
    $_SESSION['aluno']['taxa_inscricao'] = 'Paga';
  }

  if ($_SESSION['aluno']['opcao_curso'] == '1') {
    $_SESSION['aluno']['opcao_curso'] = '1 ano';
  }
  else {
    $_SESSION['aluno']['opcao_curso'] = '2 anos';
  }

  if ($_SESSION['aluno']['unidade'] == 'at5') {
    $_SESSION['aluno']['unidade'] = 'AT5';
  }
  else {
    $_SESSION['aluno']['unidade'] = 'Cidade Aracy';
  }

  if ($_SESSION['aluno']['questionario'] == 'ok') {
    $_SESSION['aluno']['questionario'] = 'Preenchido';
  }
  else {
    $_SESSION['aluno']['questionario'] = 'Não preenchido';
  }

  if ($_SESSION['aluno']['foto'] == 's') {
    $_SESSION['aluno']['foto'] = 'Sim';
  }
  else {
    $_SESSION['aluno']['foto'] = 'Não';
  }

  if ($_SESSION['aluno']['matricula'] == 'ok') {
    $_SESSION['aluno']['matricula'] = 'OK';
  }
  else if ($_SESSION['aluno']['matricula'] == 'faber') {
    $_SESSION['aluno']['matricula'] = 'Faber';
  }
  else {
    $_SESSION['aluno']['matricula'] = 'Não OK';
  }

  if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') {
    $_SESSION['aluno']['pagamento_matricula'] = 'Paga';
  }
  else {
    $_SESSION['aluno']['pagamento_matricula'] = 'Não paga';
  }

  if ($_SESSION['aluno']['convocado'] == 's') {
    $_SESSION['aluno']['convocado'] = 'Sim';
  }
  else if ($_SESSION['aluno']['convocado'] == 'n') {
    $_SESSION['aluno']['convocado'] = 'Não';
  }
  else {
    $_SESSION['aluno']['convocado'] = 'Indefinido';
  }
  

?>

    <p class="coluna">Número de inscrição </p><p class="coluna2"><?php echo $_SESSION['aluno']['numero_inscricao'] ?></p><br />
    <p class="coluna">Ano </p><p class="coluna2"><?php echo $_SESSION['aluno']['ano'] ?></p><br />
    <p class="coluna">Nome </p><p class="coluna2"><?php echo $_SESSION['aluno']['nome'] ?></p><br />
    <p class="coluna">Sexo </p><p class="coluna2"><?php echo $_SESSION['aluno']['sexo'] ?></p><br />
    <p class="coluna">Data de nascimento </p><p class="coluna2"><?php echo $_SESSION['aluno']['data'] ?></p><br />
    <p class="coluna">Cor </p><p class="coluna2"><?php echo $_SESSION['aluno']['cor'] ?></p><br />
    <p class="coluna">Etnia </p><p class="coluna2"><?php echo $_SESSION['aluno']['etnia'] ?></p><br />
    <p class="coluna">Endereco </p><p class="coluna2"><?php echo $_SESSION['aluno']['endereco'] ?></p><br />
    <p class="coluna">Número</p><p class="coluna2"><?php echo $_SESSION['aluno']['numero'] ?></p><br />
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
    <p class="coluna">Unidade </p><p class="coluna2"><?php echo $_SESSION['aluno']['unidade'] ?></p><br />
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

<!-- na alteração de informações, não deveria ser possível mudar o ano e o número de inscrição do candidato -->
<!-- também estão faltando vários campos aqui!!!!
     hummm, na verdade, acho que não estão. Campos como etnia e cor são retirados do questionário e não serão 
     modificados doravante. Uma modificação deles implicaria na modificação do questionário, o que não é 
     desejável -->

      <h2>Alterar informações</h2>

      <a href="alunos.php?action=consulta_aluno&numero_inscricao=<?php echo $_SESSION['aluno']['numero_inscricao'] ?>&ano=<?php echo $_SESSION['aluno']['ano'] ?>"><img src="imagens/cancelar.gif" /> Cancelar alteração</a><br /><br />

      <form id="frmAlterar" name="frmAlterar" method="post" action="alunos.php">
        <label for="txtNumero_inscricao">Número de inscrição</label><input id="txtNumero_inscricao" name="numero_inscricao|!" type="text" value="<?php echo $_SESSION['aluno']['numero_inscricao'] ?>" maxlength="10" style="width:80px" /><br />
<?php if ($_SESSION['erros']['numero_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Número de inscrição não preenchido</p>"); ?>
<?php if ($_SESSION['erros']['numero_inscricao']['JA_EXISTE']) printf("<p class=\"erro\">Este número de inscrição e ano já estão cadastrados no sistema</p><br />"); ?>
        <label for="txtAno">Ano</label><input id="txtAno" name="ano|!#" type="text" value="<?php echo $_SESSION['aluno']['ano'] ?>" maxlength="4" style="width:35px" /><br />
<?php if ($_SESSION['erros']['ano']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano não preenchido</p>"); ?>
<?php if ($_SESSION['erros']['ano']['JA_EXISTE']) printf("<p class=\"erro\">Este número de inscrição e ano já estão cadastrados no sistema</p><br />"); ?>
        <label for="txtNome">Nome</label><input id="txtNome" name="nome|!" type="text" value="<?php echo $_SESSION['aluno']['nome'] ?>" maxlength="100" /><br />
<?php if ($_SESSION['erros']['nome']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Nome não preenchido</p>"); ?>
        <label for="txtRg">RG</label><input id="txtRg" name="rg" type="text" value="<?php echo $_SESSION['aluno']['rg'] ?>" maxlength="20" style="width:90px" /><br />
        <label for="txtOrgao">Órgão emissor</label><input id="txtOrgao" name="rg_orgao_emissor" type="text" value="<?php echo $_SESSION['aluno']['rg_orgao_emissor'] ?>" maxlength="6" style="width:80px" /><br />
        <label for="txtCpf">CPF</label><input id="txtCpf" name="cpf" type="text" value="<?php echo $_SESSION['aluno']['cpf'] ?>" maxlength="14" style="width:110px" /><br />
        <label for="txtNome_mae">Nome da mãe (completo)</label><input id="txtNome_mae" name="nome_mae" type="text" value="<?php echo $_SESSION['aluno']['nome_mae'] ?>" maxlength="100" /><br />
        <label for="txtNome_pai">Nome do pai (completo)</label><input id="txtNome_pai" name="nome_pai" type="text" value="<?php echo $_SESSION['aluno']['nome_pai'] ?>" maxlength="100" /><br />
        <label for="txtEndereco">Endereço do candidato</label><input id="txtEndereco" name="endereco" type="text" value="<?php echo $_SESSION['aluno']['endereco'] ?>" maxlength="255" /><br />
<?php if ($_SESSION['erros']['endereco']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Endereço não preenchido</p>"); ?>
        <label for="txtNumero">Número</label><input id="txtNumero" name="numero" type="text" value="<?php echo $_SESSION['aluno']['numero'] ?>" maxlength="50" style="width:80px" /><br />
        <label for="txtComplemento">Complemento</label><input id="txtComplemento" name="complemento" type="text" value="<?php echo $_SESSION['aluno']['complemento'] ?>" maxlength="255" /><br />
        <label for="txtBairro">Bairro</label><input id="txtBairro" name="bairro" type="text" value="<?php echo $_SESSION['aluno']['bairro'] ?>" maxlength="255" /><br />
        <label for="txtCidade">Cidade</label><input id="txtCidade" name="cidade" type="text" value="<?php echo $_SESSION['aluno']['cidade'] ?>" maxlength="255" /><br />
<?php if ($_SESSION['erros']['cidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Cidade não preenchido</p>"); ?>
        <label for="txtCep">CEP</label><input id="txtCep" name="cep" type="text" value="<?php echo $_SESSION['aluno']['cep'] ?>" maxlength="9" style="width:70px" /><br />
        <label for="txtTel_residencial">Telefone residencial</label><input id="txtTel_residencial" name="telefone_residencial" type="text" value="<?php echo $_SESSION['aluno']['telefone_residencial'] ?>" maxlength="13" style="width:100px" /><br />
        <label for="txtTel_outro">Outro telefone</label><input id="txtTel_outro" name="telefone_outro" type="text" value="<?php echo $_SESSION['aluno']['telefone_outro'] ?>" maxlength="13" style="width:100px" /><br />
        <label for="txtAno_conclusao">Ano de conclusão do ensino médio</label><input id="txtAno_conclusao" name="ano_conclusao|#" type="text" value="<?php echo $_SESSION['aluno']['ano_conclusao'] ?>" maxlength="4" style="width:35px" /><br />
<?php if ($_SESSION['erros']['ano_conclusao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Ano de conclusão não preenchido</p>"); ?>
        <label>Taxa de inscrição</label>
        <input id="radPaga" name="taxa_inscricao" type="radio" value="pg" class="radio" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') echo "checked=\"true\" " ?>/><label for="radPaga" class="radio">Paga</label>
        <input id="radNaopaga" name="taxa_inscricao" type="radio" value="npg" class="radio" <?php if ($_SESSION['aluno']['taxa_inscricao'] == 'npg') echo "checked=\"true\" " ?>/><label for="radNaopaga" class="radio">Não paga</label>
        <br />
<?php if ($_SESSION['erros']['taxa_inscricao']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Taxa de inscrição não selecionada!</p><br />"); ?>
        <label>Opção de curso</label>
        <input id="radUm" name="opcao_curso" type="radio" value="1" class="radio" <?php if ($_SESSION['aluno']['opcao_curso'] == '1') echo "checked=\"true\" " ?>/><label for="radUm" class="radio">1 ano</label>
        <input id="radDois" name="opcao_curso" type="radio" value="2" class="radio" <?php if ($_SESSION['aluno']['opcao_curso'] == '2') echo "checked=\"true\" " ?>/><label for="radDois" class="radio">2 anos</label>
        <br />
<?php if ($_SESSION['erros']['opcao_curso']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Opção de curso não selecionada!</p><br />"); ?>
        <label>Unidade</label>
        <input id="radAt5" name="unidade" type="radio" value="at5" class="radio" <?php if ($_SESSION['aluno']['unidade'] == 'at5') echo "checked=\"true\" " ?>/><label for="radAt5" class="radio">AT5</label>
        <input id="radCidadearacy" name="unidade" type="radio" class="radio" value="aracy" <?php if ($_SESSION['aluno']['unidade'] == 'aracy') echo "checked=\"true\" " ?>/><label for="radCidadearacy" class="radio">Cidade Aracy</label>
        <br />
<?php if ($_SESSION['erros']['unidade']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Unidade não selecionada!</p><br />"); ?>
        <label>Pagamento da matrícula</label>
        <input id="radMatpaga" name="pagamento_matricula" type="radio" value="pg" class="radio" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') echo "checked=\"true\" " ?>/><label for="radMatpaga" class="radio">Paga</label>
        <input id="radMatnaopaga" name="pagamento_matricula" type="radio" value="npg" class="radio" <?php if ($_SESSION['aluno']['pagamento_matricula'] == 'npg') echo "checked=\"true\" " ?>/><label for="radMatnaopaga" class="radio">Não paga</label>
        <br />
<?php if ($_SESSION['erros']['pagamento_matricula']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Pagamento de matrícula não selecionado!</p><br />"); ?>
        <label>Convocado</label>
        <input id="radConvocado" name="convocado" type="radio" value="s" class="radio" <?php if ($_SESSION['aluno']['convocado'] == 's') echo "checked=\"true\" " ?>/><label for="radConvocado" class="radio">Sim</label>
        <input id="radNaoconvocado" name="convocado" type="radio" value="n" class="radio" <?php if ($_SESSION['aluno']['convocado'] == 'n') echo "checked=\"true\" " ?>/><label for="radNaoconvocado" class="radio">Não</label><br />
        <label></label>
        <input id="radIndefinido" name="convocado" type="radio" value="i" class="radio" <?php if ($_SESSION['aluno']['convocado'] == 'i') echo "checked=\"true\" " ?>/><label for="radIndefinido" class="radio">Indefinido</label>
<?php if ($_SESSION['erros']['convocado']['NAO_PREENCHIDO']) printf("<p class=\"erro\">Convocamento não selecionado!</p><br />"); ?>
<!-- IMPORTANTE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
fazer todas as mensagens de erro em todas as ocasiões: cadastro, alteração, etc!!!!!!!!!!!!!!!!!!!!!!
IMPORTANTE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
        <br /><br />
        <label></label>
        <input id="btnCadastrar" name="alterar" type="submit" value="Alterar" class="botao" />
        <input id="btnCancelar" name="cancelar" type="reset" value="Cancelar" class="botao" /><br />
      </form>

<?php
  }
  else if ($_GET['action'] == 'listagem') {

    // --------------------------------------------------------
    // LISTAGEM
    // --------------------------------------------------------

?>

      <h2>Listagem de todos os alunos</h2>

<?php

    if ($_SESSION['num_alunos'] == 0) {
      printf("      <p>Não existem alunos cadastrados</p>\n");
    }
    else {

      if (!isset($_GET['page'])) {
        $_GET['page'] = 0;
        $_GET['itens_pagina'] = 10;   // numero de itens por página
      }
      $itens_pagina = $_GET['itens_pagina'];
      if (($_GET['page'] + 1) * $itens_pagina > $_SESSION['num_alunos']) {
        $limite_sup = $_SESSION['num_alunos'];
      }
      else {
        $limite_sup = ($_GET['page'] + 1) * $itens_pagina;
      }

      printf("      <ul>\n");
      printf("        <li>Total de alunos cadastrados: %d</li>", $_SESSION['num_alunos']);
      printf("        <li>Mostrando registros de %d a %d</li>", $_GET['page'] * $itens_pagina + 1, $limite_sup);
      printf("      </ul>\n");
      printf("      <br />\n");
      printf("      <table>\n");
      printf("        <tr><th class=\"vazio\"></th><th class=\"vazio\"></td><th class=\"numero\">N &ordm;</th><th class=\"ano\">Ano</th><th class=\"nome\">Nome</th><th class=\"questionario\">Questionário</th></tr>\n");
      $classe = '';
      for ($i = $_GET['page'] * $itens_pagina; $i < ($_GET['page'] + 1) * $itens_pagina && $i < $_SESSION['num_alunos']; ++$i) {

        $aluno = $_SESSION['alunos'][$i];
        if ($aluno['questionario'] == 'nok') {
          $questionario = '<a href="alunos.php?action=questionario&numero_inscricao='.$aluno['numero_inscricao'].'&ano='.$aluno['ano'].'">não preenchido</a>';
        }
        else {
          $questionario = 'preenchido';
        }
        printf("        <tr".$classe."><td><a href=\"alunos.php?action=consulta_aluno&numero_inscricao=%d&ano=%d\"><img src=\"imagens/lupa.png\" alt=\"Consultar aluno\" title=\"Consultar aluno\"/></a></td>
          <td><a href=\"alunos.php?action=editar&numero_inscricao=%d&ano=%d\"><img src=\"imagens/editar.png\" alt=\"Editar\" title=\"Editar\"/></a></td>
          <td class=\"numero\">%d</td><td class=\"ano\">%d</td><td>%s</td><td>%s</td></tr>\n",
          $aluno['numero_inscricao'], $aluno['ano'],
          $aluno['numero_inscricao'], $aluno['ano'],
          $aluno['numero_inscricao'], $aluno['ano'], $aluno['nome'], $questionario);
        if ($classe == '')
          $classe = ' class="alt"';
        else
          $classe = '';
      }
      printf("      </table><br />\n");
      printf("      <p>");
      if ($_GET['page'] > 0) {
        printf("<a href=\"alunos.php?action=listagem&page=%d&itens_pagina=%d\"><img src=\"imagens/seta_esq.gif\" alt=\"Página anterior\" title=\"Página anterior\" /></a> &nbsp; ", $_GET['page'] - 1, $_GET['itens_pagina']);
      }
      printf("Página atual : %d", $_GET['page'] + 1);
      if (($_GET['page'] + 1) * $itens_pagina < $_SESSION['num_alunos']) {
        printf(" &nbsp; <a href=\"alunos.php?action=listagem&page=%d&itens_pagina=%d\"><img src=\"imagens/seta_dir.gif\" alt=\"Próxima página\" title=\"Próxima página\" /></a>", $_GET['page'] + 1, $_GET['itens_pagina']);
      }
      printf("</p>");
    }

  }
?>

<?php

  unset($_SESSION['aluno']);
  unset($_SESSION['erros']);

  write_footer();

  write_down();

?>