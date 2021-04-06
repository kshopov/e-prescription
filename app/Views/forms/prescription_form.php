
<div class="container">
    <?php if (isset($validation)) { ?>
        <div class="col-12" style="margin-top: 50px">
            <div class="alert alert-danger" role="alert">
                <?php echo $validation->listErrors(); ?>
            </div>
        </div>
    <?php } ?>
    <?php echo form_open('eprescription/index'); ?>
    <div class="row form-prescription" style="margin-top: 50px;">
        <div class="form-group col-md-12">
            <h4>Потребителски данни</h4>
        </div>
        <div class="form-group col-md-3">
            <label for="inputFName">Име*</label>
            <input type="text" class="form-control" id="inputFName" name="inputFName">
        </div>
        <div class="form-group col-md-3">
            <label for="inputMName">Презиме</label>
            <input type="text" class="form-control" id="inputMMame" name="inputMMame">
        </div>
        <div class="form-group col-md-3">
            <label for="inputLName">Фамилия*</label>
            <input type="text" class="form-control" id="inputLName" name="inputLName">
        </div>
        <div class="form-group col-md-3">
            <label for="inputIdent">ЕГН/ЛНЧ/SSN/Паспорт/Друг*</label>
            <input type="text" class="form-control" id="inputIdent" name="inputIdent">
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputBirthdate">Дата на раждане*</label>
                <input type="text" class="form-control" id="inputBirthdate" name="inputBirthdate">
            </div>
            <div class="form-group col-md-2">
                <label for="inputGender">Пол*</label>
                <select name="gender" id="selectGender" class="form-control">
                    <option value="" selected></option>
                    <option value="man">Мъж</option>
                    <option value="woman ">Жена</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="inputAge">Възраст*</label>
                <input type="number" class="form-control" id="inputAge" min="0" max="120" name="inputAge">
            </div>
            <div class="form-group col-md-1">
                <label for="inputWeight">Тегло</label>
                <input type="number" class="form-control" id="inputWeight">
            </div>
            <div class="form-group col-md-2" style="margin-top: 10px">
                <label for="inputPregnancy">Бременност</label>
                <input type="checkbox" name="inputPregnancy" value="pregnancy">
                <label for="inputBreastfeeding">Кърмене</label>
                <input type="checkbox" name="breastfeeding" value="breastfeeding">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrescrNum">Номер на рец. книжка</label>
                <input type="text" class="form-control" id="inputPrescrNum">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputCountryCode">Код на държавата*</label>
                <input type="text" class="form-control" id="inputCountryCode" name="inputCountryCode">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCountry">Държава</label>
                <input type="text" class="form-control" id="inputcountry">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCity">Град*</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Адрес</label>
                <input type="text" class="form-control" id="inputAddress">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPostalCode">Пощенски код</label>
                <input type="text" class="form-control" id="inputPostalCode">
            </div>
            <!--
           ** КРАЙ НА ПОТРЕБИТЕЛСКИТЕ ДАННИ **
            -->
            <!--
                ** ОТ ТУК ЗАПОЧВА РЕЦЕПТАТА **
            -->
            <div class="form-group col-md-12">
                <h4>Рецепта</h4>
            </div>
            <div class="form-group col-md-4">
                <label for="inputLRN">LRN*</label>
                <input type="text" class="form-control" id="inputLRN" name="inputLRN" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="inputPrescriptionDate">Дата*</label>
                <input type="text" class="form-control" id="inputPrescriptionDate" name="inputPrescriptionDate">
            </div>
            <div class="form-group col-md-3" style="margin-top: 20px">
                <label for="inputPregnancy">За многократна употреба</label>
                <input type="checkbox" name="inputPregnancy" value="pregnancy">
            </div>
            <div id="medicationParent" class="form-group col-md-12 ">
                <div id="medication" class="row" style="background-color: #efefef; margin-left: 10px; margin-right: 10px">
                    <div class="form-group col-md-12">
                        <h4>Медикамент</h4>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="seqId">№</label>
                        <input type="text" class="form-control" id="seqId" name="seqId" value="1" disabled>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="medicationIdentifier">Идентификатор*</label>
                        <input type="text" class="form-control" id="medicationIdentifier" name="medicationIdentifier">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="medicationName">Име на лекарството</label>
                        <input type="text" class="form-control" id="medicationName" name="medicationName">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="medicationForm">Форма на лекарството*</label>
                        <input type="text" class="form-control" id="medicationForm" name="medicationForm">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="quantity">Количество*</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="medicationNote">Бележка</label>
                        <textarea rows="5" class="form-control" id="medicationNote" name="medicationNote"> </textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <h4>Инструкции за дозировка</h4>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputSeqExecution">Поредност</label>
                        <input type="number" class="form-control" id="inputSeqExecution" min="0" max="120" name="inputSeqExecution">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="route">Начин на приемане</label>
                        <input type="text" class="form-control" id="route" name="route" value="route cl013">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="doseQuantity">Количество*</label>
                        <input type="number" class="form-control" id="doseQuantity" name="doseQuantity" step="0.1">
                    </div>
                    <div class="form-group col-md-3" style="margin-top: 20px">
                        <label for="inputNeeded">Прием при необходимост</label>
                        <input type="checkbox" name="inputNeeded">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="doseQuantity">Форма на дозировка*</label>
                        <input type="text"  class="form-control" id="doseQuantity" name="doseQuantity" value="cl035 dose quantity unit">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="frequency">Честота* </label>
                        <input type="number" class="form-control" id="frequency" name="frequency">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="period">Период*</label>
                        <input type="number" class="form-control" id="period" name="period" step="0.1">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPeriodUnit">Период*</label>
                        <select name="inputPeriodUnit" id="inputPeriodUnit" class="form-control">
                            <option value="" selected></option>
                            <option value="sec">Секунда</option>
                            <option value="min ">Минута</option>
                            <option value="hour ">Час</option>
                            <option value="week ">Седмица</option>
                            <option value="month ">Месец</option>
                            <option value="year ">Година</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="therapyDuration">Продължителност</label>
                        <input type="number" class="form-control" id="therapyDuration" name="therapyDuration" step="1">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPeriodUnit">Период</label>
                        <select name="inputPeriodUnit" id="inputPeriodUnit" class="form-control">
                            <option value="" selected></option>
                            <option value="sec">Секунда</option>
                            <option value="min ">Минута</option>
                            <option value="hour ">Час</option>
                            <option value="week ">Седмица</option>
                            <option value="month ">Месец</option>
                            <option value="year ">Година</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="whenToTake">Период</label>
                        <select name="whenToTake" id="whenToTake" class="form-control">
                            <option value="" selected></option>
                            <option value="sec">Сутрин</option>
                            <option value="min ">Рано сутрин</option>
                            <option value="hour ">Късно Сутрин</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="instructionsNote">Инструкции</label>
                        <textarea rows="5" class="form-control" id="instructionsNote" name="instructionsNote"> </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:10px" class="form-group">
        <div class="col-sm-12 controls">
            <button type="submit" class="btn" style="background-color: #456073; color: white;">Запиши</button>
        </div>
    </div>
</form>
    <button onclick="appendMedication()">Добави медикамент</button>
</div>

<script type="text/javascript">
    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#inputPrescriptionDate").datepicker({
        format: "yyyy-mm-dd"
    }).datepicker("setDate", new Date());

    var counter = 2;
    function appendMedication() {
        $('#medicationParent').append('<div id="medication" class="row" style="background-color: #efefef; margin-left: 10px; margin-right: 10px">\n' +
            '                    <div class="form-group col-md-12">\n' +
            '                        <h4>Медикамент</h4>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-1">\n' +
            '                        <label for="seqId">№</label>\n' +
            '                        <input type="text" class="form-control" id="seqId" name="seqId" value="'+counter+'" disabled>\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-2">\n' +
            '                        <label for="medicationIdentifier">Идентификатор*</label>\n' +
            '                        <input type="text" class="form-control" id="medicationIdentifier" name="medicationIdentifier">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-5">\n' +
            '                        <label for="medicationName">Име на лекарството</label>\n' +
            '                        <input type="text" class="form-control" id="medicationName" name="medicationName">\n' +
            '                    </div>\n' +
            '                    <div class="form-group col-md-3">\n' +
            '                        <label for="medicationForm">Форма на лекарството*</label>\n' +
            '                        <input type="text" class="form-control" id="medicationForm" name="medicationForm">\n' +
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
        counter++;
    }

</script>