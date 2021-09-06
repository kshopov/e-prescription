function autocompleteMedicationName(medName, medIdentId, medForm, medFormId) {
    var medNameId = "#" + medName;
    var medIdentId = medIdentId; 
    var medForm = medForm;
    var medFormId = medFormId;

    var medicationName = document.getElementById(medName);
    var medicationLable = document.getElementById('medicationLable');

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
                    }
                });
            },
            select: function(event, ui) {
                $(medNameId).val(ui.item.value);
                $(medIdentId).val(ui.item.MED_ID);
                $(medForm).val(ui.item.med_form);
                $(medFormId).val(ui.item.NHIS_CODE);
                return false;
            }
        });
    });
}

//row num is the number of row in current medication up to 3 
//medication num is the number of medication up to 5
function changeMedicationView(rowNum, medicationNum) {
    var medicationIDs = ['1', '2', '3'];
    var elementToHide = '';
    var elementToShow = 'medicationrow' + medicationIDs[++rowNum] + medicationNum;

    if(rowNum == 3) {
        elementToHide = 'medicationrow' + 3 + medicationNum;
        elementToShow = 'medicationrow' + 1 + medicationNum;
    } else {
        elementToHide = 'medicationrow' + rowNum + '' + medicationNum;
    }

    document.getElementById(elementToShow).hidden = false;
    document.getElementById(elementToHide).hidden = true;

    switch(elementToShow) {
        case 'medicationrow11' :
            enableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow21' :
            disableFirstRow(medicationNum);
            enableSecondRow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow31' :
            disableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            enableThirdRow(medicationNum);
            break;
        case 'medicationrow12' :
            enableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow22' :
            disableFirstRow(medicationNum);
            enableSecondRow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow32' :
            disableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            enableThirdRow(medicationNum);
            break;
        case 'medicationrow13' :
            enableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow23' :
            disableFirstRow(medicationNum);
            enableSecondRow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow33' :
            disableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            enableThirdRow(medicationNum);
            break;
        case 'medicationrow14' :
            enableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow24' :
            disableFirstRow(medicationNum);
            enableSecondRow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow34' :
            disableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            enableThirdRow(medicationNum);
            break;
        case 'medicationrow15' :
            enableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow25' :
            disableFirstRow(medicationNum);
            enableSecondRow(medicationNum);
            disableThirdrow(medicationNum);
            break;
        case 'medicationrow35' :
            disableFirstRow(medicationNum);
            disableSecondrow(medicationNum);
            enableThirdRow(medicationNum);
            break;
    }
}

function enableFirstRow(medicationNum) {
    document.getElementById('howManyTimes' + medicationNum).disabled = false;
    document.getElementById('howMuch' + medicationNum).disabled = false;

    document.getElementById('medicationRowEnabled1' + medicationNum).value = '1';
    document.getElementById('medicationRowEnabled2' + medicationNum).value = '';
    document.getElementById('medicationRowEnabled3' + medicationNum).value = '';
}

function enableSecondRow(medicationNum) {
    document.getElementById('morning' + medicationNum).disabled = false;
    document.getElementById('lunch' + medicationNum).disabled = false;
    document.getElementById('evening' + medicationNum).disabled = false;
    document.getElementById('night' + medicationNum).disabled = false;

    document.getElementById('medicationRowEnabled1' + medicationNum).value = '';
    document.getElementById('medicationRowEnabled2' + medicationNum).value = '1';
    document.getElementById('medicationRowEnabled3' + medicationNum).value = '';
}

function enableThirdRow(medicationNum) {
    document.getElementById('by' + medicationNum).disabled = false; 
    document.getElementById('period' + medicationNum).disabled = false; 
    document.getElementById('periodfrom' + medicationNum).disabled = false; 

    document.getElementById('medicationRowEnabled1' + medicationNum).value = '';
    document.getElementById('medicationRowEnabled2' + medicationNum).value = '';
    document.getElementById('medicationRowEnabled3' + medicationNum).value = '1';
}

function disableFirstRow(medicationNum) {
    document.getElementById('howManyTimes' + medicationNum).disabled = true;
    document.getElementById('howMuch' + medicationNum).disabled = true;

    return;
}

function disableSecondrow(medicationNum) {
    document.getElementById('morning' + medicationNum).disabled = true;
    document.getElementById('lunch' + medicationNum).disabled = true;
    document.getElementById('evening' + medicationNum).disabled = true;
    document.getElementById('night' + medicationNum).disabled = true;
}

function disableThirdrow(medicationNum) {
    document.getElementById('by' + medicationNum).disabled = true; 
    document.getElementById('period' + medicationNum).disabled = true; 
    document.getElementById('periodfrom' + medicationNum).disabled = true; 
}

function validatePrescriptionForm() {
    var medicationName1 =  document.getElementById('medicationName1');
    var medicationName2 =  document.getElementById('medicationName2');
    var medicationName3 =  document.getElementById('medicationName3');
    var medicationName4 =  document.getElementById('medicationName4');
    var medicationName5 =  document.getElementById('medicationName5');

    if (isEmpty(medicationName1) && isEmpty(medicationName2) && isEmpty(medicationName3)
        && isEmpty(medicationName4) && isEmpty(medicationName5)) {
        alert('Моля, изберете поне един лекарствен продукт');
        return;
    }

    if(!isEmpty(medicationName1)) {
        if(validateQuantity(1) == false) {
            return;
        }

        if(!validateDosageInstruction(1)) {
            return;
        }
    }

    if(!isEmpty(medicationName2)) {
        if(validateQuantity(2) == false) {
            return;
        }

        if(!validateDosageInstruction(2)) {
            return;
        }
    }

    if(!isEmpty(medicationName3)) {
        if(validateQuantity(3) == false) {
            return;
        }

        if(!validateDosageInstruction(3)) {
            return;
        }
    }

    if(!isEmpty(medicationName4)) {
        if(validateQuantity(4) == false) {
            return;
        }

        if(!validateDosageInstruction(4)) {
            return;
        }
    }

    if(!isEmpty(medicationName5)) {
        if(validateQuantity(5) == false) {
            return;
        }

        if(!validateDosageInstruction(5)) {
            return;
        }
    }

    document.getElementById('prescriptionForm').submit();
    //ако всички валидации са ок преминаваме към създаването на ajax и инсъртване в дб
    // sendAjax();
}

function validateQuantity(id) {
    var quantity = document.getElementById('quantity'+id);
    var quantityLbl = document.getElementById('quantityLable' + id);

    if(isEmpty(quantity)) {
        alert('Полето количество не може да бъде празно или отрицателно число')
        quantity.focus();
        quantity.select();

        return false;
    }
    return true;
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
                // document.getElementById("successful_prescription").hidden = false;
                alert('Успешно издадена електронна рецепта');
                location.reload();
                // document.getElementById("prescriptionForm").reset(); 
                $("#inputPrescriptionDate").datepicker({
                    format: "yyyy-mm-dd"
                }).datepicker("setDate", new Date());
                setTimeout(function(){
                    // document.getElementById('successful_prescription').hidden = true;
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

function validateDosageInstruction(id) {
    var istructionFirstRow = document.getElementById('medicationrow1' + id);
    var instructionSecondRow = document.getElementById('medicationrow2' + id);
    var instructionThirdRow = document.getElementById('medicationrow3' + id);

    if(istructionFirstRow.hidden == false) {
        return validateInstructionFirstRow(id);
    } else if (instructionSecondRow.hidden == false) {
        return validateInstructionSecondRow(id);
    } else {
        return validateInstructionThirdRow(id);
    }
}

function validateInstructionFirstRow(id) {
    var howManyTimes = document.getElementById('howManyTimes' + id);
    // var howManyTimesLable = document.getElementById('howManyTimesLable');
    var howMuch = document.getElementById('howMuch' + id);
    // var howMuchLable = document.getElementById('howMuchLable');

    if(isEmpty(howManyTimes) || howManyTimes.value <= 0) {
        alert('Полето \'Моля, уточнете колко пъти да се приема избрания медикамент\'');
        // howManyTimes.style.backgroundColor = "#FFDCDC";
        // howManyTimesLable.style.color = "#ff0000";

        howManyTimes.focus();
        howManyTimes.select();
        return false;
    }

    if(isEmpty(howMuch) || howMuch.value <= 0) {
        alert('Полето \'Моля, уточнете по колко да се приема избрания медикамент\'');
        // howMuch.style.backgroundColor = "#FFDCDC";
        // howMuchLable.style.color = "#ff0000";
        howMuch.focus();
        howMuch.select();
        return false;
    } 

    return true;
}

function validateInstructionSecondRow(id) {
    var morning = document.getElementById('morning' + id);
    var lunch = document.getElementById('lunch' + id);
    var evening = document.getElementById('evening' + id);
    var night = document.getElementById('night' + id);

    if((isEmpty(morning) || morning.value <= 0) && 
    (isEmpty(lunch) || lunch.value <= 0) &&
    (isEmpty(evening) || evening.value <= 0) &&
    (isEmpty(night) || night.value <= 0) ) {
        alert('\'Моля, уточнете по колко да се приема избрания медикамент\'');

        morning.focus();
        morning.select();
    }
}

function validateInstructionThirdRow(id) {
    var by = document.getElementById('by' + id);
    var period = document.getElementById('period' + id);

    if(isEmpty(by) || by.value <= 0) {
        alert('\'Моля, уточнете по колко да се приема избрания медикамент\'');
        by.focus();
        by.select();

        return;
    } 

    if(isEmpty(period) || period.value <= 0) {
        alert('\'Моля, уточнете по колко да се приема избрания медикамент\'');
        period.focus();
        period.select();

        return;
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