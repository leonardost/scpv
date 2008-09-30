<?php

// Funções para banco de dados

$db = "mysql";
$host = "localhost";
$user = "root";
$pass = "";

function conectar() {
  global $db;
  global $host;
  global $user;
  global $pass;
  $funcao = $db . "_connect";
  if ($db == "mysql")
    $funcao($host, $user, $pass)
      or die("Erro na conexão!");
}

function selecionar_banco($banco) {
  global $db;
  if ($db == "mysql")
    mysql_select_db($banco)
      or die("O banco " . $banco . " não pôde ser selecionado!");
}

// Executa uma query SQL e retorna um resource como resultado
function query($strSql) {
  global $db;
  $funcao = $db . "_query";
  return $funcao($strSql);
}

// Retorna o número de registros em um resource
function num_rows($resource) {
  global $db;
  $funcao = $db . "_num_rows";
  return $funcao($resource);
}

// Retorna um array associativo representando o registro
function fetch_array($resource) {
  global $db;
  $funcao = $db . "_fetch_array";
  return $funcao($resource);
}

function desconectar() {
  global $db;
  if ($db == "mysql")
    mysql_close();
}

?>