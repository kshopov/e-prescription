function autocompleteMedicationName(medNameId, medIdentId, medForm, medFormId) {
    var medNameId = medNameId;
    var medIdentId = medIdentId; 
    var medForm = medForm;
    var medFormId = medFormId;

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
                $(medNameId).val(ui.item.value);
                $(medIdentId).val(ui.item.MEDIKAMENT_UNIQUE_CODE);
                $(medForm).val(ui.item.med_form);
                $(medFormId).val(ui.item.NHIS_CODE);
                return false;
            }
        });
    });
}

function validatePrescriptionForm() {
    var medRow1 = document.getElementById('medicationrow1');
    var medRow2 = document.getElementById('medicationrow2');
    var medRow3 = document.getElementById('medicationrow3');

    if(medRow1.hidden == false) {
        validateFirstRow();
    } else if (medRow2.hidden == false) {
        console.log('validating med row 2');
    } else if (medRow3.hidden == false) {
        console.log('validating med row 3');
    }
}

function validateFirstRow() {
    var medicationName = document.getElementById('medicationNameRow1');
    var medicationLable = document.getElementById('medicationLable');

    var howManyTimes = document.getElementById('howMuch');
    var quantity = document.getElementById('quantity');
    var package = document.getElementById('package');
    
    if(isEmpty(medicationName)) {
        medicationName.style.backgroundColor = "#FFDCDC";
        medicationLable.style.color = "#ff0000";
    } else {
        medicationName.style.backgroundColor = "white";
        medicationLable.style.color = "black";
    }
}

function isEmpty(field) {
    return ( $.trim(field.value).length == 0 );
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
        console.log('eqweqe');
        singlePrescription.checked= true;
        multiplePrescription.checked = false;
        inputRepeatsNumber.value = '';
        inputRepeatsNumber.disabled = true;
    } else if (chk == '2') {
        singlePrescription.checked= false;
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

function autocompleteCity(inputCityNameId, inputPostalCodeId) {
    $(function () {
        $(inputCityNameId).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "/eprescription/searchCity",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $(inputPostalCodeId).val(ui.item.post_code);
                $(inputCityNameId).val(ui.item.value);
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

var medicationCounter = 1;
function appendMedication() {
    var medNameId = '#medicationName' + medicationCounter;
    var medIdentId = '#medicationIdentifier' + medicationCounter;
    var medFormId = '#medicationForm' + medicationCounter;
    
    $('#medicationParent').append('<div id="medication" class="row" style="background-color: #efefef; margin-left: 10px; margin-right: 10px">\n' +
            '                    <div class="form-group col-md-12">\n' +
            '                        <h4>Медикамент</h4>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="seqId">№</label>\n' +
            '                        <input type="text" class="form-control" id="seqId" name="seqId" value="' + medicationCounter + '" disabled>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="medicationIdentifier">Идентификатор*</label>\n' +
            '                        <input type="text" class="form-control" id="medicationIdentifier' + medicationCounter + '" name="medicationIdentifier[' + medicationCounter  +']' + '">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-5">\n' +
            '                        <label for="medicationName">Име на лекарството</label>\n' +
            '                        <input type="text" class="form-control" id="medicationName' + medicationCounter + '" \n\
                                            name="medicationName[' + medicationCounter + ']' + '" oninput="autocompleteMedicationName('+ '\'' + medNameId +'\',\'' + medIdentId + '\',\'' + medFormId +'\')">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-3">\n' +
            '                        <label for="medicationForm">Форма на лекарството*</label>\n' +
            '                        <input type="text" class="form-control" id="medicationForm' + medicationCounter + '" name="medicationForm[' + medicationCounter +']">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="quantity">Количество*</label>\n' +
            '                        <input type="text" class="form-control" id="quantity" name="quantity[' + medicationCounter + ']">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-8">\n' +
            '                        <label for="medicationNote">Бележка</label>\n' +
            '                        <textarea rows="5" class="form-control" id="medicationNote" name="medicationNote"> </textarea>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-12">\n' +
            '                        <h4>Инструкции за дозировка</h4>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="inputSeqExecution">Поредност</label>\n' +
            '                        <input type="number" class="form-control" id="inputSeqExecution" min="0" max="120" name="inputSeqExecution">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-4">\n' +
            '                        <label for="route">Начин на приемане</label>\n' +
            '                        <input type="text" class="form-control" id="route" name="route" value="route cl013">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="doseQuantity">Количество*</label>\n' +
            '                        <input type="number" class="form-control" id="doseQuantity" name="doseQuantity" step="0.1">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-3" style="margin-top: 20px">\n' +
            '                        <label for="inputNeeded">Прием при необходимост</label>\n' +
            '                        <input type="checkbox" name="inputNeeded">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-5">\n' +
            '                        <label for="doseQuantity">Форма на дозировка*</label>\n' +
            '                        <input type="text"  class="form-control" id="doseQuantity" name="doseQuantity" value="cl035 dose quantity unit">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="frequency">Честота* </label>\n' +
            '                        <input type="number" class="form-control" id="frequency" name="frequency">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="period">Период*</label>\n' +
            '                        <input type="number" class="form-control" id="period" name="period" step="0.1">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-4">\n' +
            '                        <label for="inputPeriodUnit">Период*</label>\n' +
            '                        <select name="inputPeriodUnit" id="inputPeriodUnit" class="form-control">\n' +
            '                            <option value="" selected></option>\n' +
            '                            <option value="sec">Секунда</option>\n' +
            '                            <option value="min ">Минута</option>\n' +
            '                            <option value="hour ">Час</option>\n' +
            '                            <option value="week ">Седмица</option>\n' +
            '                            <option value="month ">Месец</option>\n' +
            '                            <option value="year ">Година</option>\n' +
            '                        </select>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="therapyDuration">Продължителност</label>\n' +
            '                        <input type="number" class="form-control" id="therapyDuration" name="therapyDuration" step="1">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="inputPeriodUnit">Период</label>\n' +
            '                        <select name="inputPeriodUnit" id="inputPeriodUnit" class="form-control">\n' +
            '                            <option value="" selected></option>\n' +
            '                            <option value="sec">Секунда</option>\n' +
            '                            <option value="min ">Минута</option>\n' +
            '                            <option value="hour ">Час</option>\n' +
            '                            <option value="week ">Седмица</option>\n' +
            '                            <option value="month ">Месец</option>\n' +
            '                            <option value="year ">Година</option>\n' +
            '                        </select>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-3">\n' +
            '                        <label for="whenToTake">Период</label>\n' +
            '                        <select name="whenToTake" id="whenToTake" class="form-control">\n' +
            '                            <option value="" selected></option>\n' +
            '                            <option value="sec">Сутрин</option>\n' +
            '                            <option value="min ">Рано сутрин</option>\n' +
            '                            <option value="hour ">Късно Сутрин</option>\n' +
            '                        </select>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-8">\n' +
            '                        <label for="instructionsNote">Инструкции</label>\n' +
            '                        <textarea rows="5" class="form-control" id="instructionsNote" name="instructionsNote"> </textarea>\n' +
            '                    </div>\n' +
            '                </div>');
    medicationCounter++;
}