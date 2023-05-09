function notEmpty(elem, helperMsg) {
    var result = true;
    if (elem.value.length == 0) {
        result = false;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isNumeric(elem, helperMsg) {
    var numericExpression = /^[0-9]+$/;
    var result = false;
    if (elem.value.match(numericExpression)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isAlphabet(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]+$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isAlphabetOrNull(elem, helperMsg) {
    var alphaExp = /^[A-Za-zà-üÀ-Ü ]*$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isAlphanumeric(elem, helperMsg) {
    var alphaExp = /^[0-9a-zA-Z]+$/;
    var result = false;
    if (elem.value.match(alphaExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function lengthRestriction(elem) {
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

function madeSelection(elem, helperMsg) {
    var result = true;
    if (elem.value == "default") {
        result = false;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function oneIsSelected(elem, helperMsg) {
    var result = false;
    for (var i = 0; i < elem.length; i++) {
        if (elem[i].checked == true) {
            result = true;
            break;
        }
    }
    tractarError(elem[0].parentElement, result, helperMsg);
    return result;
}

function emailValidator(elem, helperMsg) {
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    var result = true;
    if (!elem.value.match(emailExp)) {
        result = false;
        elem.focus();
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function checkedBox(elem, helperMsg) {
    var result = true;
    if (elem.checked == false) {
        result = false;
    }
    tractarError(elem.parentElement, result, helperMsg);
    return result;
}

function isCIF(elem, helperMsg) {
    var cifExp = /^[A-Z]\-[0-9]{8}$/gm;
    var result = false;
    if (elem.value.match(cifExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isPhonenumber(elem, helperMsg) {
    var phoneExp = /^[0-9]{9}$/;
    var result = false;
    if (elem.value.match(phoneExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}

function isYears(elem, helperMsg) {
    var yearExp = /^[0-9]{4}\-[0-9]{4}$/;
    var result = false;
    if (elem.value.match(yearExp)) {
        result = true;
    }
    tractarError(elem, result, helperMsg);
    return result;
}
