function validateIdentity() {
    var egn = document.getElementById('inputIdent');
    var indetifierType = document.getElementById('indentifierTy').selectedOptions[0].value;
    var age = document.getElementById('inputAge');
    var gender = document.getElementById('selectGender');
    

    var identifierTypeLabel = document.getElementById('inputIdentLabel');

    if (indetifierType == 1 ) {
        if (!validateEGN(egn.value)) {
            identifierTypeLabel.style.color = "#ff0000";
            egn.style.backgroundColor = "#FFDCDC";
            age.value = '';
            gender.value = '';
            $('#inputBirthdate').datepicker({
                format: 'yyyy-mm-dd'
            }).datepicker("setDate", '');

        } else {
            identifierTypeLabel.style.color = "black";
            egn.style.backgroundColor = "white";
            gender.value = getGenderFromEGN(egn);
            var birthdate = getBirthDateFromEGN(egn);
            $('#inputBirthdate').datepicker({
                format: 'yyyy-mm-dd'
            }).datepicker("setDate", birthdate);
            age.value = getAgeFromBirthdate(new Date(birthdate));
        }
    }
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