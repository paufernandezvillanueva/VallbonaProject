let curs_add_control = {
    "name": [isYears, "El nom no valid"],
};


window.onload = function() {
    document.forms['addCursForm'].addEventListener("submit", formValidator);

    for (let x in curs_add_control) {
        document.forms['addCursForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in curs_add_control) {
        elem = document.forms['addCursForm'][x];

        if (!curs_add_control[x][0](elem, curs_add_control[x][1], curs_add_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['addCursForm'][x];
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
    curs_add_control[e.target.name][0](e.target, curs_add_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-add-curs-error").classList = "error"
        document.getElementById(elem.name + "-add-curs-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-curs-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-curs-error").innerHTML = msgError;
    }
}