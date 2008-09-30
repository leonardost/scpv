<?php

class Label {
  var $for;
  var $label;


}

class Input {

  var $id;
  var $name;
  var $value;
  var $maxlenght;
  var $classe;

  function Input() {
    $this->id = '';
    $this->name = '';
    $this->value = '';
    $this->maxlenght = '';
    $this->classe = '';
  }

  function render() {
    printf('<input id="%s" name="%s" value="%" maxlenght="%d"',
      $this->id, $this->name, $this->value, $this->maxlenght);
    if ($this->classe != '') {
      printf(' class="%s"', $this->classe);
    }
    printf(">\n");
  }

}

// representa um form html
class Form {

  var $action;
  var $method;
  var $elements;
  var $number;          // numero de campos

  function Form($action = '', $method = 'POST') {
    $this->action = $action;
    $this->method = $method;
    $this->elements = array();
    $this->number = 0;
  }

  function createElement($type, $id, $name, $extra, $value) {
    // extra = label, maxlenght, checked, rows, cols, etc.
    // field = nome humano do campo (endereco -> endereço)
    $this->elements[$this->number] = array('type' => $type, 'id' => $id, 'name' => $name, 'value' => $value);
    if ($extra != '') {
      foreach ($extra as $k => $v) {
        $this->elements[$this->number][$k] = $v;
      }
    }

    $this->number++;
  }

  function createLabel($label) {
    $this->elements[$this->number] = array('type' => 'label', 'name' => $label);
    $this->number++;
  }

  function createSelect($label, $id, $name, $choices) {
    // $choices = array contendo todas as escolhas possíveis (fazer um marcador para saber qual tem o atributo selected)
    $this->elements[$this->number] = array('type' => 'select', 'id' => $id, 'name' => $name, 'choices' => $choices);
    $this->number++;
  }

  function render() {
    // escreve todo o formulário

    printf("<form action=\"$this->action\" method=\"$this->method\">\n");

    for ($i = 0; $i < $this->number; $i++) {

      $elem = $this->elements[$i];
      if ($elem['class'] != '') {
        $class = ' class="'.$elem['class'].'"';
      }

      //printf("<input id=\"%s\" type=\"%s\" name=\"%s\" value=\"%s\" ", $elem['id'], $elem['type'], $elem['name'], $elem['value']);

      switch ($elem['type']) {

        case 'text':
        case 'password':
          if ($elem['label'] != '') {
            printf("<label for=\"%s\">%s</label>", $elem['id'], $elem['label']);
          }
          printf("<input id=\"%s\" type=\"%s\" name=\"%s\" value=\"%s\" maxlenght=\"%s\"%s><br />\n",
            $elem['id'], $elem['type'], $elem['name'], $elem['value'], $elem['maxlenght'], $class);
          break;

        case 'label':
          printf("<label>%s</label>\n", $elem['name']);
          break;

        case 'radio':
        case 'checkbox':
          printf("<input id=\"%s\" type=\"%s\" name=\"%s\" value=\"%s\"%s>\n",
            $elem['id'], $elem['type'], $elem['name'], $elem['value'], $class);
          if ($elem['label'] != '') {
            printf("<label for=\"%s\">%s</label>\n", $elem['id'], $elem['label']);
          }
          break;

        case 'select':
          if ($elem['label'] != '') {
            printf("<label for=\"%s\">%s</label>", $elem['id'], $elem['label']);
          }
          printf("<select id=\"%s\" name=\"%s\"%s>\n", $elem['id'], $elem['name'], $class);
          foreach ($choices as $k => $v) {
            printf("<option value=\"%s\">%s</option>\n", $k, $v);
          }
          printf("</select>\n");
          break;

        case 'textarea':
          if ($elem['label'] != '') {
            printf("<label for=\"%s\">%s</label>", $elem['id'], $elem['label']);
          }
          printf("<textarea id=\"%s\" name=\"%s\" rows=\"\" cols=\"\"%s>%s</textarea><br />\n",
            $elem['id'], $elem['name'], $elem['rows'], $elem['cols'], $class, $elem['value']);
          break;

        case 'submit':
        case 'reset':
        case 'hidden':
          printf("<input id=\"%s\" type=\"%s\" name=\"%s\" value=\"%s\"%s><br />\n",
            $elem['id'], $elem['type'], $elem['name'], $elem['value'], $class);
          break;

      }

      if ($_SESSION['erros'][$this->elements[$i]['name']]) {
        if ($_SESSION['erros'][$this->elements[$i]['name']]['NAO_PREENCHIDO'])
          printf("<p class=\"erro\">campo obrigatório</p><br />\n");
      }


    }

    printf("</form>\n");

  }

}

?>