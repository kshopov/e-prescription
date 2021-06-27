// function validateForm() {
//     // var form = document.getElementById('userForm');
//     // form.addEventListener('submit', function(e) {
//     //     e.preventDefault();
//     // });
// }

function validateIdentity() {
    if (indetifierType == 1 ) {
        if (!validateEGN(egn.value)) {
            identifierTypeLabel.style.color = "#ff0000";
            egn.style.backgroundColor = "#FFDCDC";
            age.value = '';
            gender.value = '';
            $('#inputBirthdate').datepicker({
                format: 'yyyy-mm-dd'
            }).datepicker("setDate", '');
            age.readOnly = false;
            birtDateField.readOnly = false;
            gender.readOnly = false;
            country.readOnly = false;
            countryCode.readOnly = false;
        } else {
            identifierTypeLabel.style.color = "black";
            egn.style.backgroundColor = "white";
            gender.value = getGenderFromEGN(egn);
            var birthdate = getBirthDateFromEGN(egn);
            $('#inputBirthdate').datepicker({
                format: 'yyyy-mm-dd'
            }).datepicker("setDate", birthdate);
            age.value = getAgeFromBirthdate(new Date(birthdate));
            age.readOnly = true;
            birtDateField.readOnly = true;
            gender.readOnly = true;
            countryCode.value = 'BG';
            countryCode.readOnly = true;
            country.readOnly = true;
            country.value = 'България';
        }
    } else if (indetifierType == 2) {
        if(!isValidLNCH(egn.value)) {
            identifierTypeLabel.style.color = "#ff0000";
            egn.style.backgroundColor = "#FFDCDC";
        } else {
            identifierTypeLabel.style.color = "black";
            egn.style.backgroundColor = "white";
        }
    }
}

function validateFirtsName() {
    if (indetifierType == 1 ) {
        if(!isCyrillic(firstNameField.value)) {
            firstNameField.style.backgroundColor = "#FFDCDC";
            inputFNameLabel.style.color =  "#ff0000";
        } else {
            firstNameField.style.backgroundColor = "white";
            inputFNameLabel.style.color = "black";
        }
    }
}

function validateMidName() {
    if (indetifierType == 1 ) {
        if(!isCyrillic(midNameField.value)) {
            midNameField.style.backgroundColor = "#FFDCDC";
            inputMNameLabel.style.color =  "#ff0000";
        } else {
            midNameField.style.backgroundColor = "white";
            inputMNameLabel.style.color = "black";
        }
    }

    if (midNameField.value.length == 0) {
        midNameField.style.backgroundColor = "white";
        inputMNameLabel.style.color = "black";
    }
}

function validateLastName() {
    if (indetifierType == 1 ) {
        if(!isCyrillic(inputLName.value)) {
            inputLName.style.backgroundColor = "#FFDCDC";
            inputLNameLable.style.color =  "#ff0000";
        } else {
            inputLName.style.backgroundColor = "white";
            inputLNameLable.style.color = "black";
        }
    }
}

function emptyForm() {
    indetifierType = document.getElementById('indentifierType').selectedOptions[0].value;

    egn.style.backgroundColor = "white";
    identifierTypeLabel.style.color = "black";
    egn.value = '';
    age.value = '';
    gender.value = '';
    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    }).datepicker("setDate", '');
    age.disabled = false;
    birtDateField.disabled = false;
    gender.disabled = false;
    country.disabled = false;
    country.value = '';
    countryCode.disabled = false;
    countryCode.value = '';

    firstNameField.style.backgroundColor = "white";
    firstNameField.value = '';
    inputFNameLabel.style.color = "black";

    midNameField.style.backgroundColor = "white";
    midNameField.value = '';
    inputMNameLabel.style.color = "black";

    inputLName.style.backgroundColor = "white";
    inputLNameLable.style.color = "black";
    inputLName.value = '';

    inputPhone.value = '';
    cityInputField.value = '';
}

function getBirthDateFromEGN(egn) {
    var year = Number(egn.value.substr(0, 2));
    var month = egn.value.substr(2, 2);
    var day = Number(egn.value.substr(4, 2));

    if (month >= 40) {
        year += 2000;
        month -= 40;
    } else if (month >= 20) {
        year += 1800;
        month -= 20;
    } else {
        year += 1900;
    }

    return year + '-' + month + '-' + day;
}

function getGenderFromEGN(egn) {
    return egn.value[8] % 2 == 0 ? 1 : 2;
}

function getAgeFromBirthdate(birthday) {
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch

    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

/*
 * от тук започват помощни методи за различните полета
 *
*/
function isCyrillic(name) {
    return /^[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ-]+$/.test(name);
}

function minLength(minLength, value) {
    return value.length >= minLength;
}

function maxLength(maxLength, value) {
    return value.length <= maxLength;
}

// function isValidDate(dateString) {
//     var regEx = /^\d{4}-\d{2}-\d{2}$/;
//     if(!dateString.match(regEx)) return false;  // Invalid format
//     var d = new Date(dateString);
//     var dNum = d.getTime();
//     if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
//     return d.toISOString().slice(0,10) === dateString;
//   }
