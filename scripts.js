window.onload = load;

function load() {
  var itens = document.getElementById("menu").getElementsByTagName("ul")[0].getElementsByTagName("li");
  for (var i = 0; i < itens.length; ++i) {
    var obj = itens[i].getElementsByTagName("ul");
    if (obj[0]) {
      itens[i].onmouseover = function() { this.getElementsByTagName("ul")[0].style.display = "block"; }
      itens[i].onmouseout = function() { this.getElementsByTagName("ul")[0].style.display = "none"; }
    }
  }
}