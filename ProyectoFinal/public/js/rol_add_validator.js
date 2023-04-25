let rol_add_control = {
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
};


window.onload = function() {
    document.forms['addRolForm'].addEventListener("submit", formValidator);

    for (let x in rol_add_control) {
        document.forms['addRolForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in rol_add_control) {
        elem = document.forms['addRolForm'][x];

        if (!rol_add_control[x][0](elem, rol_add_control[x][1], rol_add_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['addRolForm'][x];
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
    rol_add_control[e.target.name][0](e.target, rol_add_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-add-rol-error").classList = "error"
        document.getElementById(elem.name + "-add-rol-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-rol-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-rol-error").innerHTML = msgError;
    }
}