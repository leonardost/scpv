<?php

include('form/label.php');
include('form/input.php');
include('form/radio.php');
include('form/checkbox.php');
//include('form/select.php');
include('form/textarea.php');
include('form/hidden.php');
include('form/button.php');
include('form/element.php');

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

  function addLabel($for = '', $label = '', $classe = '') {
    $this->elements[$this->number++] = new Label($for, $label, $classe);
  }
  function addInput($id, $name, $value, $maxlenght, $classe, $password) {
    $this->elements[$this->number++] = new Input($id, $name, $value, $maxlenght, $classe, $password);
  }
  function startRadio($id, $name) {
    $this->elements[$this->number] = new Radio($id, $name);
  }
  function addRadiobutton($id, $classe, $value, $label) {
    $this->elements[$this->number]->addChoice($id, $classe, $value, $label);
  }
  function endRadio() {
    $this->number++;
  }
  function addCheckbox() {
    $this->elements[$this->number++] = new Checkbox($id, $name, $classe, $value, $label);
  }

/*  function startSelect($id, $name) {
  }
  function addSelect() {

  }
  function endSelect() {
  }*/

  function addTextarea($id, $name, $value, $rows, $cols, $classe) {
    $this->elements[$this->number++] = new Textarea($id, $name, $value, $rows, $cols, $classe);
  }
  function addHidden($id, $name, $value) {
    $this->elements[$this->number++] = new Textarea($id, $name, $value);
  }
  function addSubmit($id, $name, $value, $classe) {
    $this->elements[$this->number++] = new Submit($id, $name, $value, $classe);
  }
  function addReset($id, $name, $value, $classe) {
    $this->elements[$this->number++] = new Reset($id, $name, $value, $classe);
  }

  // permite adicionar um elemeneto qualquer ao formulário (<br />, etc)
  function addElement($texto) {
    $this->elements[$this->number++] = new Element($texto);
  }

  function display() {
    // escreve todo o formulário

    printf("<form action=\"$this->action\" method=\"$this->method\">\n");

    for ($i = 0; $i < $this->number; $i++) {
      $this->elements[$i]->display();
    }

    printf("</form>\n");

  }
/*


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

*/

}

?>