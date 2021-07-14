<?php

use Ramsey\Uuid\Uuid;

$myuuid = Uuid::uuid4();
?>
<div class="container">
    <?php if (isset($patient)) { ?>
        <div class="col-12" style="margin-top: 50px; padding-bottom: 10px; border:1px solid; border-radius: 6px; border-color: grey;">
            <h3 style="text-align: center;" id="medtag">Данни за пациента</h3>
            <b>Пациент:</b>
            <?php echo $patient['FNAME'] . ' ' . $patient['LNAME']; ?><br>
            <b>Град: </b>
            <?php echo $patient['CITY']; ?><br>
            <b>Роден на: </b>
            <?php echo $patient['BIRTHDATE']; ?><br>
        </div>
    <?php } else { ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert" style="margin-top: 50px">
                <p>Моля, първо изберете пациент! </p>
                <a href="/patient/add" id="addPatientButton" class="btn" style="background-color: #456073; color: white;">Добави нов</a>
                <a href="/patient/search" id="searchPatientButton" class="btn" style="background-color: #456073; color: white;">Търсене</a>
            </div>
        </div>
    <?php return;
    } ?>
    <?php if (isset($validation)) { ?>
        <div class="col-12" style="margin-top: 50px">
            <div class="alert alert-danger" role="alert">
                <?php echo $validation->listErrors(); ?>
            </div>
        </div>
    <?php } ?>
    <?php echo form_open('eprescription/index', 'id="prescriptionForm"'); ?>
    <div class="form-row formrow">
        <div class="form-group col-md-12" style="text-align: center;">
            <h3 id="medtag">Рецепта</h3>
        </div>
        <div class="form-group col-md-2">
            <label for="inputPrescriptionDate">Дата*</label>
            <input type="text" class="form-control" id="inputPrescriptionDate" name="inputPrescriptionDate" disabled>
        </div>
        <div class="form-group col-md-3" style="margin-top: 30px">
            <input type="checkbox" id="singlePrescription" name="singlePrescription" onclick="changeRepeatsValue(1)" checked>
            <label for="inputDispansationType">Еднократно</label>
            <input type="checkbox" id="multiplePrescription" style="margin-left: 20px;" name="multiplePrescription" onclick="changeRepeatsValue(2)">
            <label for="inputDispansationType">Многократно за</label>
        </div>
        <div class="form-group col-md-2">
            <label for="inputDispansationType">бр. отпускания*</label>
            <input type="number" class="form-control" id="inputRepeatsNumber" name="inputRepeatsNumber" disabled>
        </div>
        <div class="form-group col-md-3" style="margin-top: 30px">
            <input type="checkbox" name="inputPregnancy" id="pregnancyCheckbox" onclick="changePregnancy(1)">
            <label for="inputPregnancy">Бременност</label>
            <input type="checkbox" name="inputBreastfeeding" id="breastfeadingCheckbox" onclick="changePregnancy(2)">
            <label for="inputBreastfeeding">Кърмене</label>
        </div>
    </div>
    <div class="form-row formrowwotop">
        <div class="form-grou col-md-12">
            <hr style="color: #456073;">
        </div>
    </div>

    <div class="form-row formrowwotop">
        <div class="form-group col-md-5">
            <label for="medicationNameRow1" id="medicationLable">Лекарствен продукт*</label>
            <input type="text" class="form-control" id="medicationNameRow1" name="medicationName[0]" oninput="autocompleteMedicationName('#medicationNameRow1', '#medicationNameIdRow1', '#doseQuantityCode', '#medicationForm')">
        </div>
        <div class="form-group col-md-1" >
            <label for="medicationNameRow1" id="medicationLable">ID</label>
            <input type="text" class="form-control" id="medicationNameIdRow1" name="medicationNameIdRow1">
        </div>
        <div class="form-group col-md-1">
            <label for="">Количество*</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
            <select class="form-control" name="" id="">
                <option value="1" default>оп.</option>
                <option value="2">бр.</option>
            </select>
        </div>
    </div>
    
    <div class="form-row formrowwotop" id="medicationrow1">
        <div class="form-group col-md-2">
            <label for="">Колко пъти*</label>
            <input type="text" class="form-control" id="howManyTimes" name="howManyTimes">
        </div>
        <div class="form-group col-md-2">
            <label for="">По колко*</label>
            <input type="text" class="form-control" id="howMuch" name="howMuch">
        </div>
        <div class="form-group col-md-1" style="margin-top: 38px;">
            <i class="fas fa-cog" onclick="changeMedicationView('1')"></i>
        </div>
    </div>

    <div class="form-row formrowwotop" id="medicationrow2" hidden>
        <div class="form-group col-md-1">
            <label for="">Сутрин</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">Обед</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">Вечер</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">Нощ</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1" style="margin-top: 38px;">
            <i class="fas fa-cog" onclick="changeMedicationView('2')"></i>
        </div>
    </div>

    <div class="form-row formrowwotop" id="medicationrow3" hidden>
        <div class="form-group col-md-1">
            <label for="">По</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">За период</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-2">
            <label for="">от</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1" style="margin-top: 38px;">
            <i class="fas fa-cog" onclick="changeMedicationView('3')"></i>
        </div>
    </div>
    
    <div class="form-row formrowwotop" id="medicationrow2" hidden>
        <div class="form-group col-md-5">
            <label for="medicationName">Лекарствен продукт</label>
            <input type="text" class="form-control" id="medicationNameRow2" name="medicationName[0]" oninput="autocompleteMedicationName('#medicationName', '#medicationIdentifier', '#medicationForm')">
        </div>
        <div class="form-group col-md-1">
            <label for="">Количество</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
            <select class="form-control" name="" id="">
                <option value="1" default>оп.</option>
                <option value="2">бр.</option>
            </select>
        </div>
    </div>
    <div class="form-row formrowwotop" id="medicationrow3" hidden>
        <div class="form-group col-md-5">
            <label for="medicationName">Лекарствен продукт</label>
            <input type="text" class="form-control" id="medicationNameRow3" name="medicationName[0]" oninput="autocompleteMedicationName('#medicationName', '#medicationIdentifier', '#medicationForm')">
        </div>
        
        <div class="form-group col-md-1">
            <label for="">Количество</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
            <select class="form-control" name="" id="">
                <option value="1" default>оп.</option>
                <option value="2">бр.</option>
            </select>
        </div>
    </div>
    <div class="form-row formrowwotop">
        <div class="form-group col-md-5">
            <label for="medicationName">Указания за приема</label>
            <input type="text" class="form-control" id="medicationName" name="medicationName[0]">
        </div>
        <div class="form-group col-md-4">
            <label for="medicationForm">Мерна единица</label>
            <input type="text" class="form-control" name="doseQuantityCode" id="doseQuantityCode">
        </div>
        <div class="form-group col-md-1">
            <label for="medicationForm" id="medicationLable">form ID</label>
            <input type="text" class="form-control" id="medicationForm" name="medicationForm">
        </div>
        <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
        </div>
        <div class="form-group col-md-1">
            <label for="">За</label>
            <input type="text" class="form-control" id="" name="">
        </div>
        <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
            <select class="form-control" name="" id="">
                <option value="1" default>дни</option>
                <option value="2">месеца</option>
                <option value="3">години</option>
            </select>
        </div>
    </div>
    <input type="hidden" class="form-control" id="inputLRN" name="inputLRN" value="<?php echo $myuuid->toString() ?>">
    <div class="form-row formbottom">
        <div style="margin-top:10px" class="form-group">
            <div class="col-sm-12 controls">
                <button type="submit" onclick="validatePrescriptionForm()" id="submitButton" class="btn" style="background-color: #456073; color: white;">Запиши</button>
            </div>
        </div>
    </div>
</div>
</form>
</div>

<script type="text/javascript">
    var submitButton = document.getElementById('submitButton');
    submitButton.addEventListener("click", function(event) {
        event.preventDefault();
    });

    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#inputPrescriptionDate").datepicker({
        format: "yyyy-mm-dd"
    }).datepicker("setDate", new Date());
</script>