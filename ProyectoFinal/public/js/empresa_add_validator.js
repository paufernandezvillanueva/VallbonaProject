let empresa_add_control = {
    "cif": [isCIF, "El CIF introduit no es valid"],
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
    "sector": [isAlphabet, "El sector no pot tenir numeros o simbols"],
    "comarca_id": [madeSelection, "Cal escollir una comarca"],
    "poblacio_id": [madeSelection, "Cal escollir una poblacio"]
};


window.onload = function() {
    document.forms['addEmpresaForm'].addEventListener("submit", formValidator);

    for (let x in empresa_add_control) {
        document.forms['addEmpresaForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in control) {
        elem = document.forms['addEmpresaForm'][x];

        if (!empresa_add_control[x][0](elem, empresa_add_control[x][1], empresa_add_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['addEmpresaForm'][x];
            }
        }
    }
    
    if (!result) {
        first_error.focus();
        e.preventDefault();
    }

    return result;
}

function ErrorVisibility(e){
    empresa_add_control[e.target.name][0](e.target, empresa_add_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-add-empresa-error").classList = "error"
        document.getElementById(elem.name + "-add-empresa-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-empresa-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-empresa-error").innerHTML = msgError;
    }
}