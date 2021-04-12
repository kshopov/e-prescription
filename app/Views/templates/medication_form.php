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
