// este arquivo contém a parte de AJAX (envio e recebimento de dados)

// instancia o objeto XMLHttpRequest
function instanciaAjax() {

	var ie = new Array (
		"Msxml2.XMLHTTP 6.0",
		"Msxml2.XMLHTTP 5.0",
		"Msxml2.XMLHTTP 4.0",
		"Msxml2.XMLHTTP 3.0",
		"Msxml2.XMLHTTP",
		"Microsoft.XMLHTTP"
	);

	if (window.XMLHttpRequest != null)
		ajax = new window.XMLHttpRequest();
	else if (window.ActiveXObject != null) {
		var ok = false, e;
		for (var i = 0; i < ie.length && !ok; i++) {
			try {
				ajax = new ActiveXObject(ie[i]);
				ok = true;
			}
			catch (e) { }
		}
	}

	if (ajax == null)
		alert("Problema na função instanciaAjax()\n\nobjeto XMLHttpRequest não foi criado");

	return ajax;
}

var ajax = instanciaAjax();

function inserir() {
	// insere um novo item no arquivo "alunos.dat"
  var strRa = $("txtRa").value;
  var strNome = $("txtNome").value;
  var strApelido = $("txtApelido").value;

  if (strApelido == "")
    strApelido = '-';

  // codifica os dados em URI
  strRa = encodeURI(strRa);
  strNome = encodeURI(strNome);
  strApelido = encodeURI(strApelido);

	ajax.open("POST", "ajax.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.onreadystatechange = function() {
  	if (ajax.readyState >= 1 && ajax.readyState <= 3) {
  		$("status").style.display = "block";
  		$("status").innerHTML = "<p>Processando . . .</p>";
      $("btnCadastrar").value = "Cancelar";
  	}
  	if (ajax.readyState == 4) {
  		if (ajax.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue == "OK") {

        $("btnCadastrar").value = "Cadastrar";

  			var intRa = ajax.responseXML.getElementsByTagName("ra")[0].firstChild.nodeValue;
        var strNome = ajax.responseXML.getElementsByTagName("nome")[0].firstChild.nodeValue;
        var strApelido = ajax.responseXML.getElementsByTagName("apelido")[0].firstChild.nodeValue;

  			// atualiza lista em tempo real
  			var novo_tr = document.createElement("tr");
        $("tabelaLista").appendChild(novo_tr);

        if (ajax.responseXML.getElementsByTagName("destaque")[0])
          novo_tr.className = "alt";

        var novo_td = document.createElement("td");
        novo_tr.appendChild(novo_td);
        novo_td.className = "ra";
        novo_td.innerHTML = intRa;
        
        novo_td = document.createElement("td");
        novo_tr.appendChild(novo_td);
        novo_td.innerHTML = htmlentities(strNome);
        
        novo_td = document.createElement("td");
        novo_tr.appendChild(novo_td);
        novo_td.innerHTML = htmlentities(strApelido);

  			alert("Aluno cadastrado com sucesso!");
  			$("status").style.display = "none";
  			$("status").innerHTML = "";
        $("txtRa").focus();

  		}
  		else {
        $("status").innerHTML = "";
        novo = document.createElement("p");
        $("status").appendChild(novo);
        novo.innerHTML = ajax.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue;
  			$("txtRa").focus();
        $("btnCadastrar").value = "Cadastrar";
  		}
  	}
  };

	var strParametros = "ra=" + strRa + "&nome=" + strNome + "&apelido=" + strApelido + "&acao=inserir";
	ajax.send(strParametros);
  return;
}

function cancelar() {
  $("txtRa").value = "";
  $("txtNome").value = "";
  $("txtApelido").value = "";
  $("txtRa").focus();
  $("status").style.display = "none";
  $("status").innerHTML = "";
  $("btnCadastrar").value = "Cadastrar";
  ajax.abort();
  return false;
}

function pesquisar(ra) {
  //alert(ra);
	ajax.open("POST", "ajax.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.onreadystatechange = function() {
  	if (ajax.readyState >= 1 && ajax.readyState <= 3) {
  		$("status").style.display = "block";
  		$("status").innerHTML = "<p>Processando . . .</p>";
      $("btnCadastrar").value = "Cancelar";
  	}
  	if (ajax.readyState == 4) {
  		if (ajax.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue == "OK") {

        $("btnCadastrar").value = "Cadastrar";

  			var intRa = ajax.responseXML.getElementsByTagName("ra")[0].firstChild.nodeValue;
        var strNome = ajax.responseXML.getElementsByTagName("nome")[0].firstChild.nodeValue;
        var strApelido = ajax.responseXML.getElementsByTagName("apelido")[0].firstChild.nodeValue;

  			// preenche os campos
        $("txtNome").value = strNome;
        if (strApelido != "-")
          $("txtApelido").value = strApelido;

  			$("status").style.display = "none";
  			$("status").innerHTML = "";
        $("txtRa").focus();
        return false;

  		}
  		else {
        $("status").innerHTML = "";
        var novo = document.createElement("p");
        $("status").appendChild(novo);
        var novo2 = document.createTextNode(ajax.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue);
        novo.appendChild(novo2);
  			$("txtRa").focus();
        $("btnCadastrar").value = "Cadastrar";
  			return false;
  		}
  	}
  };

	var strParametros = "ra=" + ra + "&acao=buscar";
	ajax.send(strParametros);
  return;
}
