function autocompleteMedicationName(medNameId, medIdentId, medFormId) {
    console.log(medNameId + ' / ' + medIdentId + '/' + medFormId);
    $(function() {
        $(medNameId).autocomplete({
            minLength: 2,
            source: function (request, response) {
               $.ajax({
                    url: "eprescription/searchMedication",
                    dataType : "json",
                    data : request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $(medNameId).val(ui.item.value);
                $(medIdentId).val(ui.item.id);
                $(medFormId).val(ui.item.med_form);
                return false;
            }
        });
    });
}

function autocompleteCountry(inputId) {
    $(function () {
        $(inputId).autocomplete({
            source: '/eprescription/getCountryCode/?'
        });
    });
}

function autocompleteCity(inputId) {
    $(function () {
        $(inputId).autocomplete({
            source: '/eprescription/getCity/?'
        });
    });
}

var medicationCounter = 2;
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
            '                        <input type="text" class="form-control" id="medicationIdentifier' + medicationCounter + '" name="medicationIdentifier' + medicationCounter + '">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-5">\n' +
            '                        <label for="medicationName">Име на лекарството</label>\n' +
            '                        <input type="text" class="form-control" id="medicationName' + medicationCounter + '" \n\
                                            name="medicationName' + medicationCounter + '" oninput="autocompleteMedicationName('+ '\'' + medNameId +'\',\'' + medIdentId + '\',\'' + medFormId +'\')">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-3">\n' +
            '                        <label for="medicationForm">Форма на лекарството*</label>\n' +
            '                        <input type="text" class="form-control" id="medicationForm' + medicationCounter + '" name="medicationForm">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="quantity">Количество*</label>\n' +
            '                        <input type="text" class="form-control" id="quantity" name="quantity">\n' +
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