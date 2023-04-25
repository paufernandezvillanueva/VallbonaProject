let curs_edit_control = {
    "name": [isYears, "El nom no valid"],
};


window.onload = function() {
    document.forms['editCursForm'].addEventListener("submit", formValidator);

    for (let x in curs_edit_control) {
        document.forms['editCursForm'][x].addEventListener("change", ErrorVisibility);
    }
};

function formValidator(e) {
    var result = true;
    var first_error = null;

    for (let x in curs_edit_control) {
        elem = document.forms['editCursForm'][x];

        if (!curs_edit_control[x][0](elem, curs_edit_control[x][1], curs_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editCursForm'][x];
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
    curs_edit_control[e.target.name][0](e.target, curs_edit_control[e.target.name][1]);
}

function tractarError(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-curs-error").classList = "error"
        document.getElementById(elem.name + "-edit-curs-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-curs-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-curs-error").innerHTML = msgError;
    }
}