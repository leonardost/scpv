
document.onmousedown = mousedown;

function mousedown(e) {
  id = getObject(e).id;
  switch(id) {
    case 'adicionar_nova_questao':
      var novo_label = document.createElement('label');
      $('frmQuestionario').appendChild(novo_label);
      novo_label.setAttribute('for','
      var nova_questao = document.createElement('input');
      $('frmQuestionario').appendChild(nova_questao);
      nova_questao.setAttribute('id','questao1_blablabla');
      nova_questao.setAttribute('type','text');

      var header = $('nenhuma_questao');
      if (header) {
        header.parentNode.removeChild(header);
      }

//      if (ajax.responseXML.getElementsByTagName("destaque")[0])
//        novo_tr.className = "alt";

//      var novo_td = document.createElement("td");
//      novo_tr.appendChild(novo_td);
//      novo_td.className = "ra";
//      novo_td.innerHTML = intRa;
  }
}

var moz = document.getElementById && !document.all;

// retorna o objeto alvo de um evento
function getObject(e) {
  if (moz)
    return e.target;
  else
    return event.srcElement;
}

// substitui o document.getElementById
function $(strId) {
	var obj = document.getElementById(strId);
	if (!obj) { }
//		alert("Problema na função $(strId)\nstrId = \"" + strId + "\"\nObjeto não existe\n");
	else
		return obj;
}