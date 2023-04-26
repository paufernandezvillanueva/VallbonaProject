let contacte_edit_control = {
    "name": [isAlphabet, "El nom no pot tenir numeros o simbols"],
    "empresa_id": [madeSelection, "Cal escollir una comarca"],
    "email": [emailValidator, "Aquest correu electrònic no es valid"],
    "phonenumber": [isPhonenumber, "Aquest telefon no es valid"]
};


window.onload = function() {
    document.forms['editContacteForm'].addEventListener("submit", formValidator);

    for (let x in contacte_edit_control) {
        document.forms['editContacteForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in contacte_edit_control) {
        elem = document.forms['editContacteForm'][x];

        if (!contacte_edit_control[x][0](elem, contacte_edit_control[x][1], contacte_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editContacteForm'][x];
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
    contacte_edit_control[e.target.name][0](e.target, contacte_edit_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-contacte-error").classList = "error"
        document.getElementById(elem.name + "-edit-contacte-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-contacte-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-contacte-error").innerHTML = msgError;
    }
}