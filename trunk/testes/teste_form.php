<?php

function form($id, $name, $action, $method) {
  printf('<form id="%s" name="%s" action="%s" method="%s">', $id, $name, $action, $method);
  printf("\n");
}

function label($for, $label, $classe, $style) {
  printf('<label for="%s"', $for);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">%s</label>\n", $label);
}

function text($id, $name, $value, $maxlenght, $classe, $style) {
  printf('<input id="%s" name="%s" type="text" value="%s" maxlenght="%d"',
    $id, $name, $value, $maxlenght);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">\n");
}

function password($id, $name, $value, $maxlenght, $classe, $style) {
  printf('<input id="%s" name="%s" type="password" value="%s" maxlenght="%d"',
    $id, $name, $value, $maxlenght);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">\n");
}

function radio($id, $name, $classe, $value, $checked, $style) {
  printf('<input id="%s" name="%s" type="radio" value="%s"', $id, $name, $value);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($checked) {
    printf(' checked="true"');
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">\n");
}

function checkbox($id, $name, $classe, $value, $checked, $style) {
  printf('<input id="%s" name="%s" type="checkbox" value="%s"', $id, $name, $value);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($checked) {
    printf(' checked="true"');
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">\n");
}

function select($id, $name, $classe, $style) {
  printf('<select id="%s" name="%s"', $id, $name);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">\n");
}
function option($value, $text) {
  printf('<option value="%s">%s</option>', $value, $text);
  printf("\n");
}
function selectend() {
  printf("</select>\n");
}

function textarea($id, $name, $value, $rows, $cols, $classe, $style) {
  printf('<textarea id="%s" name="%s" rows="%d" cols="%s"',
    $id, $name, $rows, $cols);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(">%s</textarea>\n", $value);
}

function hidden($id, $name, $value) {
  printf('<input id="%s" name="%s" type="hidden" value="%s" />',
    $id, $name, $value);
  printf("\n");
}

function submit($id, $name, $value, $classe, $style) {
  printf('<input id="%s" name="%s" type="submit" value="%s"',
    $id, $name, $value);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(" />\n");
}

function resetar($id, $name, $value, $classe, $style) {
  printf('<input id="%s" name="%s" type="submit" value="%s"',
    $id, $name, $value);
  if ($classe != '') {
    printf(' class="%s"', $classe);
  }
  if ($style != '') {
    printf(' style="%s"', $style);
  }
  printf(" />\n");
}

function formend() {
  printf("</form>\n");
}

?>

<html>
<head>
  <title></title>
</head>
<body>

<?php
  form('frmTeste', 'frmTeste', 'form_processing.php', 'post');
  label('nome', 'Nome', '', ''); text('nome', 'nome', 'opa', 10, '', ''); echo '<br />';
  label('nome', 'Nome', '', ''); password('nome', 'nome', 'opa', 10, '', ''); echo '<br />';
  submit('enviar', 'enviar', 'Enviar', '', '');
  formend();
?>

</body>
</html>