function autocompleteMedicationName(medicationNum) {

    var medNameId = '#medicationName' + medicationNum;
    var medIdentId = medIdentId; 
    var medForm = medForm;
    var medFormId = medFormId;

    console.log(medNameId);


    var medicationName = document.getElementById('medicationName' + medicationNum);
    var medicationLable = document.getElementById('medicationLable' + medicationNum);

    $(function() {
        $(medNameId).autocomplete({
            minLength: 2,
            source: function (request, response) {
               $.ajax({
                    url: "/eprescription/searchMedication",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }, 
                    error : function(data) {
                        console.log('error');
                    }
                });
            },
            select: function(event, ui) {
                medicationName.style.backgroundColor = "white";
                medicationLable.style.color = "black";

                $(medNameId).val(ui.item.value);
                $(medIdentId).val(ui.item.MED_ID);
                $(medForm).val(ui.item.med_form);
                $(medFormId).val(ui.item.NHIS_CODE);
                return false;
            }
        });
    });
}

function changeMedicationView(medicationId) {
    var elementToHide = '';
    var elementToShow = 'medicationrow' + (++medicationId);
    --medicationId;
    if(medicationId == 3) {
        elementToHide = 'medicationrow' + 3;
        elementToShow = 'medicationrow' + 1;
    } else {
        elementToHide = 'medicationrow' + medicationId;
    }

    document.getElementById(elementToShow).hidden = false;
    document.getElementById(elementToHide).hidden = true;

    if(elementToShow == 'medicationrow1') {
        document.getElementById('howManyTimes').disabled = false;
        document.getElementById('howMuch').disabled = false;
        document.getElementById('medrow1active').disabled = false;
        
        document.getElementById('morning').disabled = true;
        document.getElementById('lunch').disabled = true;
        document.getElementById('evening').disabled = true;
        document.getElementById('night').disabled = true;
        document.getElementById('medrow2active').disabled = true;

        document.getElementById('by').disabled = true; 
        document.getElementById('period').disabled = true; 
        document.getElementById('periodfrom').disabled = true; 
        document.getElementById('medrow3active').disabled = true;
    } else if (elementToShow == 'medicationrow2') {
        document.getElementById('howManyTimes').disabled = true;
        document.getElementById('howMuch').disabled = true;
        document.getElementById('medrow1active').disabled = true;
        
        document.getElementById('morning').disabled = false;
        document.getElementById('lunch').disabled = false;
        document.getElementById('evening').disabled = false;
        document.getElementById('night').disabled = false;
        document.getElementById('medrow2active').disabled = false;

        document.getElementById('by').disabled = true; 
        document.getElementById('period').disabled = true; 
        document.getElementById('periodfrom').disabled = true;
        document.getElementById('medrow3active').disabled = true;
        
    } else if (elementToShow == 'medicationrow3') {
        document.getElementById('howManyTimes').disabled = true;
        document.getElementById('howMuch').disabled = true;
        document.getElementById('medrow1active').disabled = true;

        document.getElementById('morning').disabled = true;
        document.getElementById('lunch').disabled = true;
        document.getElementById('evening').disabled = true;
        document.getElementById('night').disabled = true;
        document.getElementById('medrow2active').disabled = true;

        document.getElementById('by').disabled = false; 
        document.getElementById('period').disabled = false; 
        document.getElementById('periodfrom').disabled = false; 
        document.getElementById('medrow3active').disabled = false;
    }
}

function validatePrescriptionForm(medicationNum) {
    var medicationName = document.getElementById('medicationName' + medicationNum);
    var medicationLable = document.getElementById('medicationLable' + medicationNum);

    var inputRepeatsNumber = document.getElementById('inputRepeatsNumber');
    var inputRepeatsNumberLable = document.getElementById('inputRepeatsNumberLable');

    var medicationID = document.getElementById('medicationID');

    var quantity = document.getElementById('quantity');
    var quantityLable = document.getElementById('quantityLable');

    var errors = []; 
    
    if (inputRepeatsNumber.disabled == false) {
        if(inputRepeatsNumber.value < 1 || inputRepeatsNumber.value > 6) {
            alert('Полето \'брой отпускания\' не може да е празно, да е по-малко от едно или по-голямо от шест');
            inputRepeatsNumber.style.backgroundColor = "#FFDCDC";
            inputRepeatsNumberLable.style.color = "#ff0000";
            inputRepeatsNumber.focus();
            inputRepeatsNumber.select();
            return;
        } else {
            inputRepeatsNumber.style.backgroundColor = "white";
            inputRepeatsNumberLable.style.color = "black";
        }
    }

    if(isEmpty(medicationName)) {
        alert('Полето \'Лекарствен продукт не може да е празно\'');
        medicationName.style.backgroundColor = "#FFDCDC";
        medicationLable.style.color = "#ff0000";
        medicationName.focus();
        medicationName.select();
        errors[0] = 'Полето \'Лекарствен продукт\' не може да е празно';
        return;
    } else {
        medicationName.style.backgroundColor = "white";
        medicationLable.style.color = "black";
    }

    if(isEmpty(medicationID) || medicationID.value < 1) {
    }

    if(quantity.value < 1 || isEmpty(quantity)) {
        alert('Полето \'Количество\' не може да е празно или да е по-малко от едно');
        quantity.focus();
        quantity.select();

        quantity.style.backgroundColor = "#FFDCDC";
        quantityLable.style.color = "#ff0000";

        return;
    } else {
        quantity.style.backgroundColor = "white";
        quantityLable.style.color = "black";
    }

    validateDosageInstruction();

    //ако всички валидации са ок преминаваме към създаването на ajax и инсъртване в дб
    sendAjax();
}

function sendAjax() {
    $form = document.getElementById('prescriptionForm');
    // $form.submit(function() {
        $.ajax({
            url: "add",
            type: "POST",
            data: $('#prescriptionForm').serialize(),
            dataType: "json",
            success: function( response ) {
                document.getElementById("successful_prescription").hidden = false;
                document.getElementById("prescriptionForm").reset(); 
                $("#inputPrescriptionDate").datepicker({
                    format: "yyyy-mm-dd"
                }).datepicker("setDate", new Date());
                setTimeout(function(){
                    document.getElementById('successful_prescription').hidden = true;
                },5000);
            },
            error: function(xhr, error) {

            }
          });
    //   });
}

function isEmpty(field) {
    return ( $.trim(field.value).length == 0 );
}

function validateDosageInstruction() {
    var istructionFirstRow = document.getElementById('medicationrow1');
    var instructionSecondRow = document.getElementById('medicationrow2');
    var instructionThirdRow = document.getElementById('medicationrow3');

    if(istructionFirstRow.hidden == false) {
        validateInstructionFirstRow();
    } else if (instructionSecondRow.hidden == false) {
        validateInstructionSecondRow();
    } else {
        validateInstructionThirdRow();
    }
}

function validateInstructionFirstRow() {
    var howManyTimes = document.getElementById('howManyTimes');
    var howManyTimesLable = document.getElementById('howManyTimesLable');
    var howMuch = document.getElementById('howMuch');
    var howMuchLable = document.getElementById('howMuchLable');

    if(isEmpty(howManyTimes) || howManyTimes.value <= 0) {
        alert('Полето \'Моля, уточнете колко пъти да се приема избрания медикамент\'');
        howManyTimes.style.backgroundColor = "#FFDCDC";
        howManyTimesLable.style.color = "#ff0000";

        howManyTimes.focus();
        howManyTimes.select();
        return;
    } else {
        howManyTimes.style.backgroundColor = "white";
        howManyTimesLable.style.color = "black";
    }

    if(isEmpty(howMuch) || howMuch.value <= 0) {
        alert('Полето \'Моля, уточнете по колко да се приема избрания медикамент\'');

        howMuch.style.backgroundColor = "#FFDCDC";
        howMuchLable.style.color = "#ff0000";

        howMuch.focus();
        howMuch.select();

        return;
    } else {
        howMuch.style.backgroundColor = "white";
        howMuchLable.style.color = "black";
    }
}

function validateInstructionSecondRow() {
    var morning = document.getElementById('morning');
    var morningLable = document.getElementById('morningLable');
    var lunch = document.getElementById('lunch');
    var lunchLable = document.getElementById('lunchLable');
    var evening = document.getElementById('evening');
    var eveningLable = document.getElementById('eveningLable');
    var night = document.getElementById('night');
    var nightLable = document.getElementById('nightLable');

    if((isEmpty(morning) || morning.value <= 0) && 
    (isEmpty(lunch) || lunch.value <= 0) &&
    (isEmpty(evening) || evening.value <= 0) &&
    (isEmpty(night) || night.value <= 0) ) {
        alert('Полето \'Моля, уточнете по колко да се приема избрания медикамент\'');

        morning.style.backgroundColor = "#FFDCDC";
        morningLable.style.color = "#ff0000";

        lunch.style.backgroundColor = "#FFDCDC";
        lunchLable.style.color = "#ff0000";
        
        evening.style.backgroundColor = "#FFDCDC";
        eveningLable.style.color = "#ff0000";

        night.style.backgroundColor = "#FFDCDC";
        nightLable.style.color = "#ff0000";

        morning.focus();
        morning.select();
    } else {
        morning.style.backgroundColor = "white";
        morningLable.style.color = "black";

        lunch.style.backgroundColor = "white";
        lunchLable.style.color = "black";
        
        evening.style.backgroundColor = "white";
        eveningLable.style.color = "black";

        night.style.backgroundColor = "white";
        nightLable.style.color = "black";
    }
}

function validateInstructionThirdRow() {
    var by = document.getElementById('by');
    var byLable = document.getElementById('byLable');
    var period = document.getElementById('period');
    var periodLable = document.getElementById('periodLable');

    if(isEmpty(by) || by.value <= 0) {
        alert('Полето \'Моля, уточнете по колко да се приема избрания медикамент\'');

        by.style.backgroundColor = "#FFDCDC";
        byLable.style.color = "#ff0000";

        by.focus();
        by.select();

        return;
    } else {
        by.style.backgroundColor = "white";
        byLable.style.color = "black";
    }

    if(isEmpty(period) || period.value <= 0) {
        alert('Полето \'Моля, уточнете по колко да се приема избрания медикамент\'');

        period.style.backgroundColor = "#FFDCDC";
        periodLable.style.color = "#ff0000";

        period.focus();
        period.select();

        return;
    } else {
        period.style.backgroundColor = "white";
        periodLable.style.color = "black";
    }
}

function changePregnancy(chk) {
    var pregnancy = document.getElementById('pregnancyCheckbox');
    var breastfeading = document.getElementById('breastfeadingCheckbox');

    if(chk == '1') {
        breastfeading.checked = false;
    } else if (chk == '2') {
        pregnancy.checked= false;
    }
}

function changeRepeatsValue(chk) {
    var singlePrescription = document.getElementById('singlePrescription');
    var multiplePrescription = document.getElementById('multiplePrescription');
    var inputRepeatsNumber = document.getElementById('inputRepeatsNumber');

    if(chk == '1') {
        singlePrescription.checked = true;
        multiplePrescription.checked = false;
        inputRepeatsNumber.value = '';
        inputRepeatsNumber.disabled = true;
    } else if (chk == '2') {
        singlePrescription.checked = false;
        multiplePrescription.checked = true;
        inputRepeatsNumber.disabled = false;
    }
}

function autocompleteCountry(countryNameId, countryCodeId) {
    $(function () {
        $(countryNameId).autocomplete({
        source: function (request, response) {
            $.ajax({
                    url: "/eprescription/searchCountry",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $(countryNameId).val(ui.item.value);
                $(countryCodeId).val(ui.item.alpha2);
                return false;
            }
        });
    });
}

function autocompleteCountryCode(countryNameId, countryCodeId) {
    $(function () {
        $(countryCodeId).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/eprescription/searchCountryCode",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $(countryNameId).val(ui.item.name);
                $(countryCodeId).val(ui.item.value);
                return false;
            }
        });
    });
}

function autcompleteUserData(inputIdentId) {
    $(function () {
        $(inputIdentId).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/eprescription/searchUserByIdent",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $(inputIdentId).val(ui.item.value);
                $('#inputFName').val(ui.item.p_fname);
                $('#inputMMame').val(ui.item.p_mname);
                $('#inputLName').val(ui.item.p_lname);
                $('#inputBirthdate').datepicker({
                    format: 'yyyy-mm-dd'
                }).datepicker("setDate", ui.item.p_birth_date);
                $('#selectGender').val(ui.item.p_sex);
                //$('#inputAge').val(ui.item.p_age); да се изчислява от рождената дата
                $('#inputCity').val(ui.item.g_name);
                $('#inputPostalCode').val(ui.item.g_postcode);
                $('#inputCountry').val(ui.item.gd_name);
                $('#inputCountryCode').val(ui.item.gd_alpha2);
                $('#inputPrescrNum').val(ui.item.p_prescr_book_num);

                return false;
            }
        });
    });
}