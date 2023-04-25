let cicle_edit_control = {
    "shortname": [isAlphabet, "El acronim no pot tenir numeros o simbols"],
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
};


window.onload = function() {
    document.forms['editCicleForm'].addEventListener("submit", formValidator);

    for (let x in cicle_edit_control) {
        document.forms['editCicleForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in cicle_edit_control) {
        elem = document.forms['editCicleForm'][x];

        if (!cicle_edit_control[x][0](elem, cicle_edit_control[x][1], cicle_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editCicleForm'][x];
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
    cicle_edit_control[e.target.name][0](e.target, cicle_edit_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-cicle-error").classList = "error"
        document.getElementById(elem.name + "-edit-cicle-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-cicle-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-cicle-error").innerHTML = msgError;
    }
}