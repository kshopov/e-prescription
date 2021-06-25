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
            age.disabled = false;
            birtDateField.disabled = false;
            gender.disabled = false;
            country.disabled = false;
            countryCode.disabled = false;
        } else {
            identifierTypeLabel.style.color = "black";
            egn.style.backgroundColor = "white";
            gender.value = getGenderFromEGN(egn);
            var birthdate = getBirthDateFromEGN(egn);
            $('#inputBirthdate').datepicker({
                format: 'yyyy-mm-dd'
            }).datepicker("setDate", birthdate);
            age.value = getAgeFromBirthdate(new Date(birthdate));
            age.disabled = true;
            birtDateField.disabled = true;
            gender.disabled = true;
            countryCode.value = 'BG';
            countryCode.disabled = true;
            country.disabled = true;
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

function emptyForm() {
    indetifierType = document.getElementById('indentifierTy').selectedOptions[0].value;

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