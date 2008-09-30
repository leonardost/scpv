<?php

include('control/control.php');
include('model/alunodao.php');

class AlunoControl extends Control {

  // guarda o resultado de alguma(s) consulta(s)
  var $aluno;

  function AlunoControl() {

    session_start();

    if (!$_SESSION['logado']) {
      header('Location: index.php');
      session_destroy();
      exit();
    }

    // redireciona para o local correto segundo o parametro $_GET['action'], buscando os dados necessários
    // para a exibição de cada página
    switch ($_GET['action']) {

      case 'cadastro':
        break;

      case 'consulta':
        break;

      case 'questionario':
        break;

      case 'consulta_aluno':
        $this->aluno = new AlunoDAO();
        $this->aluno->setChave('numero_inscricao', '\''.$_GET['numero_inscricao'].'\'');
        $this->aluno->setChave('ano', $_GET['ano']);
        $r = $this->aluno->consultar();
        if ($this->aluno->conexao->num_rows($r) == 0)
          $this->aluno = null;
        else {
          $a = $this->aluno->conexao->fetch_array($r);
//          $this->aluno = $a;
          $_SESSION['aluno'] = $a;
        }
        break;

      case 'editar':
        $this->aluno = new AlunoDAO();
        $this->aluno->setChave('numero_inscricao', '\''.$_GET['numero_inscricao'].'\'');
        $this->aluno->setChave('ano', $_GET['ano']);
        $r = $this->aluno->consultar();
        $a = $this->aluno->conexao->fetch_array($r);
        $_SESSION['aluno'] = $a;
        break;

      case 'listagem':
        $_SESSION['alunos'] = array();
        $this->aluno = new AlunoDAO();
        $r = $this->aluno->listar();
        $_SESSION['num_alunos'] = $this->aluno->conexao->num_rows($r);
        while ($a = $this->aluno->conexao->fetch_array($r))
          $_SESSION['alunos'][] = $a;
        break;

      case 'imprimir':
        // fazer todo o negócio de pdf aqui

        $this->aluno = new AlunoDAO();
        $this->aluno->setChave('numero_inscricao', '\''.$_GET['numero_inscricao'].'\'');
        $this->aluno->setChave('ano', $_GET['ano']);
        $r = $this->aluno->consultar();
        $a = $this->aluno->conexao->fetch_array($r);
        $_SESSION['aluno'] = $a;

        foreach ($_SESSION['aluno'] as $k => $v) {
          $_SESSION['aluno'][$k] = html_entity_decode($v);
        }

        require_once("fpdf/fpdf.php");

        define('FPDF_FONTPATH', 'fpdf/font/');

        // variaveis
        $font = 'arial';
        $startX = 10;
        $startY = 10;
        $width = 297;
        $height = 210;
        $margin = 20;     // margem contando ambos os lados

        $main_width = 220;
        $main_height = 150;
        $retorno_width = 57;
        $retorno_height = 190;
        $comprovante_width = 150;
        $comprovante_height = 40;
        $comprovanteobs_width = 70;

        $pdf= new FPDF("L", "mm", "A4");

        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();
        $pdf->SetFont($font, '', 10);
        $pdf->SetTitle("Ficha de inscrição");
        $pdf->SetSubject("Ficha de inscrição do aluno X");

        // faz caixa de fora
        $pdf->Rect($startX, $startY, $width - $margin, $height - $margin, 'D');
        // faz caixa da lateral direita
        $pdf->Rect($startX + $main_width, $startY, $retorno_width, $retorno_height, 'D');
        $pdf->Rect($startX + $main_width, $startY, $retorno_width, 40, 'D');
        $pdf->Rect($startX + $main_width + 22, $startY + 40 + 4, 30, 30, 'D');
        // faz caixa inferior
        $pdf->Rect($startX, $startY + $main_height, $comprovante_width, $comprovante_height, 'D');
        // faz caixa inferior-centro
        $pdf->Rect($startX + $comprovante_width, $startY + $main_height, $comprovanteobs_width, $comprovante_height, 'D');

        $pdf->SetFont($font, '', 12);
        $pdf->SetXY($startX + $comprovante_width + 1, $startY + $main_height + 1);
        $texto = "Este comprovante é a única garantia que você tem de efetivação de sua matrícula. Confira se seu nome e número de inscrição estão corretos. Guarde este comrpovante e apresente-o para receber sua carteirinha";
        $pdf->MultiCell($comprovanteobs_width - 2, 5.5, $texto, 0, 'J', 0);

        // parte principal
        $pdf->SetXY($startX, $startY);
        $pdf->SetFont($font, 'B', 14);
        $pdf->Cell($main_width, 12, 'Processo Seletivo - Curso Pré-vestibular da UFSCar', 0, 0, 'C', false);
        $pdf->SetFont($font, 'B', 12);
        $pdf->Text($startX + 2, $startY + 18, 'Número de inscrição:   ' . $_SESSION['aluno']['numero_inscricao']);
        $pdf->SetFont($font, '', 12);
        $pdf->Text($startX + 2, $startY + 28.2, 'Nome:   ' . $_SESSION['aluno']['nome']);
        $pdf->Text($startX + 2, $startY + 38.4, 'RG:   ' . $_SESSION['aluno']['rg']);
        $pdf->Text($startX + 70, $startY + 38.4, 'Órgão emissor:   ' . $_SESSION['aluno']['rg_orgao_emissor']);
        $pdf->Text($startX + 140, $startY + 38.4, 'CPF:   ' . $_SESSION['aluno']['cpf']);
        $pdf->Text($startX + 2, $startY + 48.6, 'Nome da mãe:   ' . $_SESSION['aluno']['nome_mae']);
        $pdf->Text($startX + 2, $startY + 58.8, 'Nome do pai:   ' . $_SESSION['aluno']['nome_pai']);
        $pdf->Text($startX + 2, $startY + 69, 'Endereço:   ' . $_SESSION['aluno']['endereco']);
        $pdf->Text($startX + 110, $startY + 69, 'Nº:   ' . $_SESSION['aluno']['numero']);
        $pdf->Text($startX + 140, $startY + 69, 'Complemento:   ' . $_SESSION['aluno']['complemento']);
        $pdf->Text($startX + 2, $startY + 79.2, 'Bairro:   ' . $_SESSION['aluno']['bairro']);
        $pdf->Text($startX + 70, $startY + 79.2, 'Cidade:   ' . $_SESSION['aluno']['cidade']);
        $pdf->Text($startX + 150, $startY + 79.2, 'CEP:   ' . $_SESSION['aluno']['cep']);
        $pdf->Text($startX + 2, $startY + 89.4, 'Telefone residencial:   ' . $_SESSION['aluno']['telefone_residencial']);
        $pdf->Text($startX + 100, $startY + 89.4, 'Outro telefone:   ' . $_SESSION['aluno']['telefone_outro']);
        if ($_SESSION['aluno']['ano_conclusao'] == 0)
          $_SESSION['aluno']['ano_conclusao'] = '';
        $pdf->Text($startX + 2, $startY + 99.6, 'Ano de conclusão do ensino médio:   ' . $_SESSION['aluno']['ano_conclusao']);
        
        if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') {
          $str = '[ X ] Paga    [  ] Não paga';
        }
        else if ($_SESSION['aluno']['taxa_inscricao'] == 'npg') {
          $str = '[  ] Paga    [ X ] Não paga';
        }
        $pdf->Text($startX + 2, $startY + 109.8, 'Taxa de inscrição:   ' . $str);
        $pdf->Text($startX + 94, $startY + 109.8, 'Assinatura do candidato: _______________________________');
        $pdf->SetFont($font, 'B', 12);
        $pdf->Text($startX + 2, $startY + 121, 'Matrícula - Ano letivo:');
        $pdf->SetFont($font, '', 12);

        if ($_SESSION['aluno']['opcao_curso'] == '1') {
          $str = '[ X ] 1 ano    [  ] 2 anos';
        }
        else if ($_SESSION['aluno']['opcao_curso'] == '2') {
          $str = '[  ] 1 ano    [ X ] 2 anos';
        }
        if ($_SESSION['aluno']['unidade'] == 'at5') {
          $str2 = '[ X ] AT5    [  ] Cidade Aracy';
        }
        else if ($_SESSION['aluno']['unidade'] == 'aracy') {
          $str2 = '[  ] AT5    [ X ] Cidade Aracy';
        }
        $pdf->Text($startX + 2, $startY + 131.2, 'Opção de curso:   '.$str.'      Unidade:   '.$str2);
        if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') {
          $str = '[ X ] Paga    [  ] Não paga';
        }
        else if ($_SESSION['aluno']['pagamento_matricula'] == 'npg') {
          $str = '[  ] Paga    [ X ] Não paga';
        }
        $pdf->Text($startX + 2, $startY + 141.4, 'Taxa de matrícula:   '.$str.'              Assinatura do aluno: _______________________________');

        // comprovante de matrícula
        $pdf->SetXY($startX, $startY + $main_height + 5);
        $pdf->Cell($comprovante_width, 0, 'Comprovante de matrícula - CPV - UFSCar', 0, 0, 'C', false);
        $pdf->SetFont($font, '', 12);
        $pdf->SetXY($startX + 1, $startY + $main_height + 15);
        $pdf->Cell($comprovante_width, 0, 'Nº de inscrição:   ' . $_SESSION['aluno']['numero_inscricao'], 0, 0, 'L', false);
        $pdf->SetXY($startX + 1, $startY + $main_height + 23);
        $pdf->Cell($comprovante_width, 0, 'Nome:   ' . $_SESSION['aluno']['nome'], 0, 0, 'L', false);
        $pdf->SetXY($startX + 1, $startY + $main_height + 36);
        if ($_SESSION['aluno']['pagamento_matricula'] == 'pg') {
          $str = '[ X ] Paga    [  ] Não paga';
        }
        else if ($_SESSION['aluno']['pagamento_matricula'] == 'npg') {
          $str = '[  ] Paga    [ X ] Não paga';
        }
        $pdf->Cell($comprovante_width, 0, 'Taxa de matrícula:   '.$str, 0, 0, 'L', false);


        // lembrete de retorno
        $pdf->SetFont($font, '', 10);

        $pdf->WriteROtie($startX + $main_width + 14, $startY + 38, "Para todas as etapas", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 19, $startY + 38, "do processo seletivo é", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 24, $startY + 38, "necessário a", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 29, $startY + 38, "apresentação desse", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 34, $startY + 38, "comprovante e do RG", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 39, $startY + 38, "ou outro documento", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 44, $startY + 38, "com foto. ", 90, 0);

        $pdf->SetFont($font, '', 13);
        $pdf->WriteRotie($startX + $main_width + 36, $startY + 70, "Local para", 90, 0);
        $pdf->WriteRotie($startX + $main_width + 42, $startY + 67, "carimbo", 90, 0);

        $pdf->WriteROtie($startX + $main_width + 8, $startY + $height - $margin - 2, 'Nº de inscrição:   ' . $_SESSION['aluno']['numero_inscricao'], 90, 0);
        $pdf->WriteROtie($startX + $main_width + 16, $startY + $height - $margin - 2, 'Nome:   ' . $_SESSION['aluno']['nome'], 90, 0);
        $pdf->SetFont($font, '', 14);
        $pdf->WriteROtie($startX + $main_width + 28, $startY + $height - $margin - 2, 'Data de retorno: ___/___/______  ', 90, 0);
        $pdf->SetFont($font, '', 10);
        $pdf->WriteROtie($startX + $main_width + 32, $startY + $height - $margin - 2, '(preenchimento do questionário socioeconômico)', 90, 0);
        if ($_SESSION['aluno']['taxa_inscricao'] == 'pg') {
          $str = '[ X ] Paga    [  ] Não paga';
        }
        else if ($_SESSION['aluno']['taxa_inscricao'] == 'npg') {
          $str = '[  ] Paga    [ X ] Não paga';
        }
        $pdf->WriteROtie($startX + $main_width + 42, $startY + $height - $margin - 2, 'Taxa de inscrição:   '.$str, 90, 0);
        $pdf->WriteROtie($startX + $main_width + 52, $startY + $height - $margin - 2, 'Este recibo somente é válido se devidamente carimbado', 90, 0);

        //imprime a saida do arquivo..
        $pdf->Output($_SESSION['aluno']['numero_inscricao'].'_'.str_replace(' ', '_', $_SESSION['aluno']['nome']),'I');

        break;

//      default:
//        header('Location: alunos.php');
//        exit();

    }

    if ($_SESSION['aluno']['ano_conclusao'] == 0) {
      $_SESSION['aluno']['ano_conclusao'] = '';
    }

    if ($_POST['cadastrar'] || $_POST['alterar'] || $_POST['pesquisar']) {

      $this->validar($_POST, 'aluno');

      // continuação da validação

      if (!isset($_SESSION['aluno']['taxa_inscricao']) && !isset($_POST['pesquisar'])) {
        $_SESSION['erros']['taxa_inscricao']['NAO_PREENCHIDO'] = true;
      }
      if (!isset($_SESSION['aluno']['opcao_curso']) && !isset($_POST['pesquisar'])) {
        $_SESSION['erros']['opcao_curso']['NAO_PREENCHIDO'] = true;
      }
      if (!isset($_SESSION['aluno']['unidade']) && !isset($_POST['pesquisar'])) {
        $_SESSION['erros']['unidade']['NAO_PREENCHIDO'] = true;
      }
      if (!isset($_SESSION['aluno']['pagamento_matricula']) && !isset($_POST['pesquisar'])) {
        $_SESSION['erros']['pagamento_matricula']['NAO_PREENCHIDO'] = true;
      }

      if (!isset($_SESSION['aluno']['convocado']) && isset($_POST['alterar'])) {
        $_SESSION['erros']['convocado']['NAO_PREENCHIDO'] = true;
      }

      $this->aluno = new AlunoDAO();

      $this->aluno->setChave('numero_inscricao', $_SESSION['aluno']['numero_inscricao']);
      $this->aluno->setChave('ano', $_SESSION['aluno']['ano']);

      $this->aluno->set('nome', $this->aspas($_SESSION['aluno']['nome']));
      $this->aluno->set('endereco', $this->aspas($_SESSION['aluno']['endereco']));
      $this->aluno->set('numero', $this->aspas($_SESSION['aluno']['numero']));
      $this->aluno->set('complemento', $this->aspas($_SESSION['aluno']['complemento']));
      $this->aluno->set('bairro', $this->aspas($_SESSION['aluno']['bairro']));
      $this->aluno->set('cidade', $this->aspas($_SESSION['aluno']['cidade']));
      $this->aluno->set('cep', $this->aspas($_SESSION['aluno']['cep']));
      $this->aluno->set('telefone_residencial', $this->aspas($_SESSION['aluno']['telefone_residencial']));
      $this->aluno->set('telefone_outro', $this->aspas($_SESSION['aluno']['telefone_outro']));
      $this->aluno->set('rg', $this->aspas($_SESSION['aluno']['rg']));
      $this->aluno->set('rg_orgao_emissor', $this->aspas($_SESSION['aluno']['rg_orgao_emissor']));
      $this->aluno->set('cpf', $this->aspas($_SESSION['aluno']['cpf']));
      $this->aluno->set('ano_conclusao', $_SESSION['aluno']['ano_conclusao']);
      $this->aluno->set('nome_mae', $this->aspas($_SESSION['aluno']['nome_mae']));
      $this->aluno->set('nome_pai', $this->aspas($_SESSION['aluno']['nome_pai']));

      $this->aluno->set('taxa_inscricao', $this->aspas($_SESSION['aluno']['taxa_inscricao']));
      $this->aluno->set('opcao_curso', $this->aspas($_SESSION['aluno']['opcao_curso']));

      if (!$_POST['pesquisar'] && empty($_SESSION['aluno']['questionario'])) {
        $_SESSION['aluno']['questionario'] = 'nok';
      }
      $this->aluno->set('questionario', $this->aspas($_SESSION['aluno']['questionario']));

      $this->aluno->set('unidade', $this->aspas($_SESSION['aluno']['unidade']));

      if (!$_POST['pesquisar'] && empty($_SESSION['aluno']['matricula'])) {
        $_SESSION['aluno']['matricula'] = 'ok';
      }
      $this->aluno->set('matricula', $this->aspas($_SESSION['aluno']['matricula']));  // matricula = inscrição?

      $this->aluno->set('pagamento_matricula', $this->aspas($_SESSION['aluno']['pagamento_matricula']));

      if ($_POST['pesquisar']) {
        $this->aluno->set('etnia', $this->aspas($_SESSION['aluno']['etnia']));
        $this->aluno->set('cor', $this->aspas($_SESSION['aluno']['cor']));
      }

      if (!$_POST['pesquisar'] && empty($_SESSION['aluno']['convocado'])) {
        $_SESSION['aluno']['convocado'] = 'i';
      }
      $this->aluno->set('convocado', $this->aspas($_SESSION['aluno']['convocado']));

    }

    //echo "<pre>";
    //print_r($_SESSION['aluno']);
    //echo "</pre>"; 

    if ($_POST['cadastrar']) {

      $r = $this->aluno->consultar();
      
      if ($this->aluno->conexao->num_rows($r) > 0) {  // checa se já existe um aluno com o código e ano fornecidos
        $_SESSION['erros']['numero_inscricao']['JA_EXISTE'] = true;
        $_SESSION['erros']['ano']['JA_EXISTE'] = true;
      }

      if (!count($_SESSION['erros']) && $this->aluno->inserir()) {
        $_SESSION['cadastro_sucesso'] = true;
        $numero_inscricao = $_SESSION['aluno']['numero_inscricao'];
        $ano = $_SESSION['aluno']['ano'];
        unset($_SESSION['aluno']);
        $_SESSION['aluno']['numero_inscricao'] = $numero_inscricao;   // para permitir a impressao dos comprovantes
        $_SESSION['aluno']['ano'] = $ano;
        header('Location: alunos.php?action=sucesso');
        exit();
      }
      else {
        header('Location: alunos.php?action=cadastro');
        exit();
      }

    }

    if ($_POST['alterar']) {

      if (!count($_SESSION['erros']) && $this->aluno->alterar()) {
        $_SESSION['alteracao_sucesso'] = true;
        unset($_SESSION['aluno']);
        header('Location: alunos.php?action=sucesso');
        exit();
      }
      else {
        header('Location: alunos.php?action=editar&numero_inscricao='.$_SESSION['aluno']['numero_inscricao'].'&ano='.$_SESSION['aluno']['ano']);
        exit();
      }

    }

    if ($_POST['pesquisar']) {

      $r = $this->aluno->pesquisar();
//      echo '---' .$r;

      if ($r) {
        $_SESSION['alunos'] = array();
        $_SESSION['num_alunos'] = $this->aluno->conexao->num_rows($r);
        while ($a = $this->aluno->conexao->fetch_array($r)) {
          $_SESSION['alunos'][] = $a;
        }
      }
      else {
        $_SESSION['num_alunos'] = 0;
      }

      header('Location: alunos.php?action=consulta&listagem=true');
      exit();

    }

  } // AlunoControl()

} // class AlunoControl


?>