window.onload = function () {
  document.getElementById("minEstadas").addEventListener("change", estadaDefiner);
  document.getElementById("minValoracio").addEventListener("change", valoracioDefiner);
}

function estadaDefiner() {
  document.getElementById("maxEstadas").min = document.getElementById("minEstadas").value;
  if (document.getElementById("maxEstadas").value < document.getElementById("maxEstadas").min && document.getElementById("maxEstadas").value != "") {
    document.getElementById("maxEstadas").value = document.getElementById("minEstadas").value
  }
}

function valoracioDefiner() {
  document.getElementById("maxValoracio").min = document.getElementById("minValoracio").value;
  if (document.getElementById("maxValoracio").value < document.getElementById("maxValoracio").min && document.getElementById("maxValoracio").value != "") {
    document.getElementById("maxValoracio").value = document.getElementById("minValoracio").value
  }
}