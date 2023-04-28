function reiniciarFiltres() {
    document.getElementById("cif").value = "";
    document.getElementById("name").value = "";
    document.getElementById("cicle").selectedIndex = "0";
    document.getElementById("sector").value = "";
    document.getElementById("comarca").selectedIndex = "0";
    document.getElementById("poblacio").selectedIndex = "0";
    document.getElementById("minEstadas").value = "";
    document.getElementById("maxEstadas").value = "";
    document.getElementById("minValoracio").value = "";
    document.getElementById("maxValoracio").value = "";
    document.getElementById("filter-form").submit();
}
