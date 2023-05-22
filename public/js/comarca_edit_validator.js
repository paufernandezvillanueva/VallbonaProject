let comarca_edit_control = {
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
};


window.onload = function() {
    document.forms['editComarcaForm'].addEventListener("submit", formValidator);

    for (let x in comarca_edit_control) {
        document.forms['editComarcaForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in comarca_edit_control) {
        elem = document.forms['editComarcaForm'][x];

        if (!comarca_edit_control[x][0](elem, comarca_edit_control[x][1], comarca_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editComarcaForm'][x];
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
    comarca_edit_control[e.target.name][0](e.target, comarca_edit_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-comarca-error").classList = "error"
        document.getElementById(elem.name + "-edit-comarca-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-comarca-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-comarca-error").innerHTML = msgError;
    }
}