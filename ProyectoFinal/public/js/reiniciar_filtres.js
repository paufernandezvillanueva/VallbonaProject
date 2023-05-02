function reiniciarFiltres() {
    const formulario = document.getElementById("filter-form");
    const elementos = formulario.elements;
    for (let i = 0; i < elementos.length; i++) {
        const element = elementos[i];
        if (
            (element.tagName === "INPUT" &&
                (element.type === "text" || element.type === "number")) ||
            element.tagName === "SELECT"
        ) {
            element.value = "";
        }
    }
    formulario.submit();
}