<?php

include('tabledao.php');

class AlunoDAO extends TableDAO {

  function AlunoDAO() {
    $this->conexao = new Conexao();
    $this->nome = 'alunos';
    $this->chaves = array('numero_inscricao' => 0, 'ano' => 0);
    $this->propriedades = array('nome' => '\'\'', 'sexo' => '\'\'', 'data_nascimento' => '\'\'',
      'cor' => '\'\'', 'etnia' => '\'\'', 'endereco' => '\'\'', 'numero' => '\'\'', 'complemento' => '\'\'', 'bairro' => '\'\'',
      'cidade' => '\'\'', 'cep' => '\'\'', 'telefone_residencial' => '\'\'', 'telefone_outro' => '\'\'',
      'email' => '\'\'', 'rg' => '\'\'', 'rg_orgao_emissor' => '\'\'', 'cpf' => '\'\'', 'ano_conclusao' => 0,
      'nome_mae' => '\'\'', 'nome_pai' => '\'\'', 'observacoes' => '\'\'', 'trabalho' => '\'\'', 'taxa_inscricao' => '\'\'',
      'opcao_curso' => '\'\'', 'questionario' => '\'\'', 'prova' => '\'\'', 'foto' => '\'\'', 'matricula' => '\'\'',
      'pagamento_matricula' => '\'\'', 'mensalidade' => 0, 'sala' => 0, 'convocado' => '\'\''
    );
  }

  // consultar um aluno específico
  function consultar() {
    $sql = 'SELECT * FROM alunos WHERE numero_inscricao = ' . $this->getChave('numero_inscricao') . ' AND ano = ' . $this->getChave('ano');
    $r = $this->conexao->query($sql);
    //echo $sql;
    return $r;
  }

  // retorna todos os alunos
  function listar() {
    $sql = 'SELECT * FROM alunos ORDER BY ano ASC, numero_inscricao ASC';
    $r = $this->conexao->query($sql);
    return $r;
  }

  // pesquisa um conjunto de alunos
  function pesquisar() {
    $sql = 'SELECT * FROM alunos WHERE 1 = 1 ';
    foreach($this->chaves as $k=>$v) {
      if ($v != "\'\'" && $v != 0) {
        $sql .= 'AND '.$k.' = '.$v.' ';
      }
    }
    foreach($this->propriedades as $k=>$v) {
      //echo $k . ' => ' . $v . '<br>';
      //echo "---" . $v . "---<br>";
      if ($v != '\'\'') {                      //  && $v != 0) {  pq isto não funciona?
        $sql .= 'AND '.$k.' = '.$v.' ';
      }
    }
    $sql .= 'ORDER BY ano ASC, numero_inscricao ASC';
    //echo $sql;
    $r = $this->conexao->query($sql);
    return $r;
  }

}

?>