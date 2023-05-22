let rol_edit_control = {
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
};


window.onload = function() {
    document.forms['editRolForm'].addEventListener("submit", formValidator);

    for (let x in rol_edit_control) {
        document.forms['editRolForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in rol_edit_control) {
        elem = document.forms['editRolForm'][x];

        if (!rol_edit_control[x][0](elem, rol_edit_control[x][1], rol_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editRolForm'][x];
            }
        }
    }
    
    if (!result) {
        if (first_error != null) {
            first_error.focus();
        }
        e.preventDefault();
    }

    return result;
}

function ErrorVisibility(e){
    rol_edit_control[e.target.name][0](e.target, rol_edit_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-rol-error").classList = "error"
        document.getElementById(elem.name + "-edit-rol-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-rol-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-rol-error").innerHTML = msgError;
    }
}