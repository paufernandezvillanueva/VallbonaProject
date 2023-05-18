let add_control = {
    "password": [minLengthRestriction, 5],
    "confirm-password": [equalTo, document.getElementById("password"), document.getElementById("confirm-password"), "La contraseña no es igual"],
};


window.onload = function() {
    document.forms['firstLoginForm'].addEventListener("submit", formValidator);

    for (let x in add_control) {
        document.forms['firstLoginForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in add_control) {
        elem = document.forms['firstLoginForm'][x];

        if (!add_control[x][0](elem, add_control[x][1], add_control[x][2], add_control[x][3])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['firstLoginForm'][x];
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
    add_control[e.target.name][0](e.target, add_control[e.target.name][1], add_control[e.target.name][2], add_control[e.target.name][3]);
}

function tractarError(elem, noError, msgError){
    if (noError){
        document.getElementById(elem.name + "-add-error").classList = "error"
        document.getElementById(elem.name + "-add-error").innerHTML = "";
    } else { 
        document.getElementById(elem.name + "-add-error").classList = "m-1 error"
        document.getElementById(elem.name + "-add-error").innerHTML = msgError;
    }
}