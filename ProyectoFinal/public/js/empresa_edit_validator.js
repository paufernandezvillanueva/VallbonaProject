let empresa_edit_control = {
    "cif": [isCIFEmpresa, "El CIF introduit no és vàlid"],
    "name": [isAlphabetEmpresa, "El nom no pot tenir números o símbols"],
    "sector": [isAlphabetEmpresaOrNull, "El sector no pot tenir números o símbols"],
    "comarca_id": [madeSelectionEmpresa, "Cal escollir una comarca"],
    "poblacio_id": [madeSelectionEmpresa, "Cal escollir una població"]
};

window.onload = function() {
    document.forms['editEmpresaForm'].addEventListener("submit", formValidatorEmpresa);

    for (let x in empresa_edit_control) {
        document.forms['editEmpresaForm'][x].addEventListener("change", ErrorVisibilityEmpresa);
    }

    document.forms['addContacteForm'].addEventListener("submit", formValidatorContacte);

    for (let x in contacte_add_control) {
        document.forms['addContacteForm'][x].addEventListener("change", ErrorVisibilityContacte);
    }

    document.forms['addEstadaForm'].addEventListener("submit", formValidatorEstada);

    for (let x in estada_add_control) {
        document.forms['addEstadaForm'][x].addEventListener("change", ErrorVisibilityEstada);
    }
};

function formValidatorEmpresa(e) {
    var result = true;
    var first_error = null;

    for (let x in empresa_edit_control) {
        elem = document.forms['editEmpresaForm'][x];

        if (!empresa_edit_control[x][0](elem, empresa_edit_control[x][1], empresa_edit_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['editEmpresaForm'][x];
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

function ErrorVisibilityEmpresa(e){
    empresa_edit_control[e.target.name][0](e.target, empresa_edit_control[e.target.name][1]);
}

function tractarErrorEmpresa(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-edit-empresa-error").classList = "error"
        document.getElementById(elem.name + "-edit-empresa-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-empresa-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-edit-empresa-error").innerHTML = msgError;
    }
}

function isCIFEmpresa(elem, helperMsg) {
    var cifExp = /^[A-Z]\-[0-9]{8}$/gm;
    var result = false;
    if (elem.value.match(cifExp)) {
        result = true;
    }
    tractarErrorEmpresa(elem, result, helperMsg);
    return result;
}

function isAlphabetEmpresa(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]+$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarErrorEmpresa(elem, result, helperMsg);
    return result;
}

function isAlphabetEmpresaOrNull(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]*$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarErrorEmpresa(elem, result, helperMsg);
    return result;
}

function madeSelectionEmpresa(elem, helperMsg) {
    var result = true;
    if (elem.value == "default") {
        result = false;
    }
    tractarErrorEmpresa(elem, result, helperMsg);
    return result;
}

let contacte_add_control = {
    "name": [isAlphabetContacte, "El nom no pot tenir números o símbols"],
    "email": [emailValidatorContacte, "Aquest correu electrònic no és vàlid"],
    "phonenumber": [isPhonenumberContacte, "Aquest telèfon no és valid"]
};

function formValidatorContacte(e) {
    var result = true;
    var first_error = null;

    for (let x in contacte_add_control) {
        elem = document.forms['addContacteForm'][x];

        if (!contacte_add_control[x][0](elem, contacte_add_control[x][1], contacte_add_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['addContacteForm'][x];
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

function ErrorVisibilityContacte(e){
    contacte_add_control[e.target.name][0](e.target, contacte_add_control[e.target.name][1]);
}

function tractarErrorContacte(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-add-contacte-error").classList = "error"
        document.getElementById(elem.name + "-add-contacte-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-contacte-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-contacte-error").innerHTML = msgError;
    }
}

function isAlphabetContacte(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]+$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarErrorContacte(elem, result, helperMsg);
    return result;
}

function madeSelectionContacte(elem, helperMsg) {
    var result = true;
    if (elem.value == "default") {
        result = false;
    }
    tractarErrorContacte(elem, result, helperMsg);
    return result;
}

function emailValidatorContacte(elem, helperMsg) {
    var emailExp = /^([\wçÇñÑ\-\.\+]+@[a-zA-Z0-9çÇñÑ\.\-]+\.[a-zA-Z0-9çÇñÑ]{2,})?$/;
    var result = true;
    if (!elem.value.match(emailExp)) {
        result = false;
        elem.focus();
    }
    tractarErrorContacte(elem, result, helperMsg);
    return result;
}

function isPhonenumberContacte(elem, helperMsg) {
    var phoneExp = /^([0-9]{9})?$/;
    var result = false;
    if (elem.value.match(phoneExp)) {
        result = true;
    }
    tractarErrorContacte(elem, result, helperMsg);
    return result;
}

let estada_add_control = {
    "student_name": [isAlphabetEstada, "El nom no pot tenir numeros o simbols"],
    "curs_id": [madeSelectionEstada, "Cal escollir un curs"],
    "cicle_id": [madeSelectionEstada, "Cal escollir un cicle"],
    "registered_by": [madeSelectionEstada, "Cal escollir un tutor"],
    "dual": [madeSelectionEstada, "Cal escollir un tipus"],
    "evaluation": [lengthRestrictionEstada, 0, 10],
};

function formValidatorEstada(e) {
    var result = true;
    var first_error = null;

    for (let x in estada_add_control) {
        elem = document.forms['addEstadaForm'][x];

        if (!estada_add_control[x][0](elem, estada_add_control[x][1], estada_add_control[x][2])) {
            result = false;
            if (first_error == null) {
                first_error = document.forms['addEstadaForm'][x];
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

function ErrorVisibilityEstada(e){
    estada_add_control[e.target.name][0](e.target, estada_add_control[e.target.name][1]);
}

function tractarErrorEstada(elem, noError, msgError){
    
    if (noError){
        elem.parentElement.classList = "col-md-10 col-sm-10"
        document.getElementById(elem.name + "-add-estada-error").classList = "error"
        document.getElementById(elem.name + "-add-estada-error").innerHTML = "";
    } else { 
        elem.parentElement.classList = "col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-estada-error").classList = "error col-md-5 col-sm-5"
        document.getElementById(elem.name + "-add-estada-error").innerHTML = msgError;
    }
}

function isAlphabetEstada(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]+$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarErrorEstada(elem, result, helperMsg);
    return result;
}

function madeSelectionEstada(elem, helperMsg) {
    var result = true;
    if (elem.value == "default") {
        result = false;
    }
    tractarErrorEstada(elem, result, helperMsg);
    return result;
}

function lengthRestrictionEstada(elem) {
    var uInput = elem.value;
    var result = false;
    if (uInput >= 0 && uInput <= 10) {
        result = true;
    }
    tractarError(
        elem,
        result,
        "La valoració ha de ser entre " + 0 + " i " + 10
    );
    return result;
}