<?php

// poder�amos definir constantes de erro em um arquivo de configuracao global

// coloca as vari�veis do formul�rio na $_SESSION['formulario'] e
// j� as valida, colocando os erros em $_SESSION['erros']

class Control {

  function Control() {

  }

  function validar($a, $tabela) {

    //      $a = array $_POST
    // $tabela = string com o nome do fomrul�rio / tabela checada

    session_start();

    $_SESSION[$tabela] = array();

    foreach ($a as $k=>$valor) {
      // seguran�a
      $k = htmlentities($k);
      $valor = htmlentities($valor);

      $posbarra = strpos($k, '|');

      if ($posbarra !== false) {
        $qtdeespeciais = $posbarra - strlen($k);
        $caracteres = substr($k, $qtdeespeciais);
        $k = substr($k, 0, $posbarra);
        $_SESSION[$tabela][$k] = $valor;

        if (strpos($caracteres, '!')) {              // campo n�o foi preenchido
          if (empty($_SESSION[$tabela][$k]))
            $_SESSION['erros'][$k]['NAO_PREENCHIDO'] = true;
        }
        if (strpos($caracteres, '#')) {              // campo deve ser num�rico
          if (!preg_match("/^([0-9]+)$/", $_SESSION[$tabela][$k]) && !empty($_SESSION[$tabela][$k]))
            $_SESSION['erros'][$k]['NUMERICO'] = true;
          if (empty($_SESSION[$tabela][$k])) {
            $_SESSION[$tabela][$k] = 0;
          }
        }
        if (strpos($caracteres, 'd')) {              // campo data
          list($dia, $mes, $ano) = split ('[/.-]', $_SESSION[$tabela][$k], 3);
          if (!checkdate($mes, $dia, $ano))
            $_SESSION['erros'][$k]['DATA'] = true;
        }
        if (strpos($caracteres, '@')) {              // campo e-mail (a implementar)

        }
      }
      else
        //if (empty($valor))
          //$_SESSION[$tabela][$k] = 0;
        //else
          $_SESSION[$tabela][$k] = $valor;

    }

    /*
    echo '<pre>';
    print_r($_SESSION['usuario']);
    print_r($_SESSION['erros']);
    echo '</pre>';
    */

  }

// retorna $v entre aspas
  function aspas($v) {
    return '\'' . $v . '\'';
  }

}

?>