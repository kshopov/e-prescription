<?php

use Ramsey\Uuid\Uuid;

$myuuid = Uuid::uuid4();
?>
<div class="container">
    <!-- <a href="https://ptest-auth.his.bg/token">token</a> -->
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
        <div class="alert alert-success" style="margin-top: 15px; text-align: center;" id="successful_prescription" role="alert" hidden>
            Успешно издадохте електронна рецепта.
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
    <?php echo form_open('eprescription/add', 'id="prescriptionForm" onload="initForm"'); ?>
    <input type="hidden" name="userId" value="<?php echo $patient['ID'] ?>">
    <div class="form-row ">
        <div class="form-group col-md-12" style="text-align: center;">
            <h3 id="medtag">Рецепта</h3>
        </div>
        <div class="form-group col-md-2">
            <label for="inputPrescriptionDate">Дата*</label>
            <input type="hidden" class="form-control" id="inputPrescriptionDate" name="inputPrescriptionDate">
            <input type="text" class="form-control" id="inputPrescriptionDate" name="inputPrescriptionDate" disabled>
        </div>
        <div class="form-group col-md-3" style="margin-top: 30px">
            <input type="checkbox" id="singlePrescription" name="singlePrescription" onclick="changeRepeatsValue(1)" checked>
            <label for="inputDispansationType">Еднократно</label>
            <input type="checkbox" id="multiplePrescription" style="margin-left: 20px;" name="multiplePrescription" onclick="changeRepeatsValue(2)">
            <label for="inputDispansationType">Многократно за</label>
        </div>
        <div class="form-group col-md-2">
            <label for="inputDispansationType" id="inputRepeatsNumberLable">бр. отпускания*</label>
            <input type="number" max="6" min="1" class="form-control" id="inputRepeatsNumber" name="inputRepeatsNumber" disabled>
        </div>
        <div class="form-group col-md-3" style="margin-top: 30px">
            <input type="checkbox" name="inputPregnancy" id="pregnancyCheckbox" onclick="changePregnancy(1)">
            <label for="inputPregnancy">Бременност</label>
            <input type="checkbox" name="inputBreastfeeding" id="breastfeadingCheckbox" onclick="changePregnancy(2)">
            <label for="inputBreastfeeding">Кърмене</label>
            <input type="hidden" class="form-control" id="inputLRN" name="inputLRN" value="<?php echo $myuuid->toString() ?>">
        </div>
    </div>
    <div class="form-row ">
        <div class="form-grou col-md-12">
            <hr style="color: #456073;">
        </div>
    </div>

    <!-- starting of medications -->
    <div class="accordion " id="prescriptionAccordion">
        <?php for ($i = 1; $i <= 5; $i++) {
        ?>
            <div class="card ">
                <div class="card-header" id="heading<?php echo $i ?>">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapse<?php echo $i ?>">
                            Медикамент #<?php echo $i ?>
                        </button>
                    </h2>
                </div>
                <?php $i === 1 ? $show = 'show' : $show = 'hide' ?>
                <div id="collapse<?php echo $i ?>" class="collapse <?php echo $show ?>" aria-labelledby="heading<?php echo $i ?>" data-target="#collapse<?php echo $i ?>">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="medicationNameRow1" id="medicationLable<?php echo $i ?>">Лекарствен продукт*</label>
                                <input type="text" class="form-control" id="medicationName<?php echo $i ?>" name="medicationName<?php echo $i ?>" oninput="autocompleteMedicationName('medicationName<?php echo $i ?>', '#medicationID<?php echo $i ?>', '#doseQuantityCode<?php echo $i ?>', '#medicationForm<?php echo $i ?>')">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="medicationForm">Лекарствена форма</label>
                                <input type="text" class="form-control" name="doseQuantityCode<?php echo $i ?>" id="doseQuantityCode<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1" hidden>
                                <label for="" id="medicationIDLable">ID</label>
                                <input type="number" min="1" class="form-control" id="medicationID<?php echo $i ?>" name="medicationID<?php echo $i ?>">
                            </div>

                            <div class="form-group col-md-1">
                                <label for="">&nbsp;</label>
                                <select class="form-control" name="package<?php echo $i ?>" id="">
                                    <option value="1" default>оп.</option>
                                    <option value="2">бр.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row " id="medicationrow1<?php echo $i ?>">
                            <input type="hidden" id="medicationRowEnabled1<?php echo $i ?>" name="medicationRowEnabled1<?php echo $i ?>" value="1">
                            <div class="form-group col-md-2">
                                <label id="howManyTimesLable">Колко пъти*</label>
                                <input type="number" min="1" class="form-control" id="howManyTimes<?php echo $i ?>" name="howManyTimes<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label id="howMuchLable">По колко*</label>
                                <input type="number" min="1" class="form-control" id="howMuch<?php echo $i ?>" name="howMuch<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1" style="margin-top: 38px;">
                                <i class="fas fa-cog" onclick="changeMedicationView('0', <?php echo $i ?>)"></i>
                            </div>
                        </div>

                        <div class="form-row " id="medicationrow2<?php echo $i ?>" hidden>
                            <input type="hidden" id="medicationRowEnabled2<?php echo $i ?>" name="medicationRowEnabled2<?php echo $i ?>" value="">
                            <div class="form-group col-md-1">
                                <label id="morningLable">Сутрин</label>
                                <input type="number" min="1" class="form-control" id="morning<?php echo $i ?>" name="morning<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label id="lunchLable">Обед</label>
                                <input type="number" min="1" class="form-control" id="lunch<?php echo $i ?>" name="lunch<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label id="eveningLable">Вечер</label>
                                <input type="number" min="1" class="form-control" id="evening<?php echo $i ?>" name="evening<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label id="nightLable">Нощ</label>
                                <input type="number" min="1" class="form-control" id="night<?php echo $i ?>" name="night<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1" style="margin-top: 38px;">
                                <i class="fas fa-cog" onclick="changeMedicationView('1', <?php echo $i ?>)"></i>
                            </div>
                        </div>
                        <div class="form-row " id="medicationrow3<?php echo $i ?>" hidden>
                            <input type="hidden" id="medicationRowEnabled3<?php echo $i ?>" name="medicationRowEnabled3<?php echo $i ?>" value="">
                            <div class="form-group col-md-1">
                                <label id="byLable">По</label>
                                <input type="number" min="1" class="form-control" id="by<?php echo $i ?>" name="by<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label id="periodLable">За период</label>
                                <input type="number" min="1" class="form-control" id="period<?php echo $i ?>" name="period<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>от</label>
                                <select class="custom-select" id="periodfrom<?php echo $i ?>" name="periodfrom<?php echo $i ?>">
                                    <option value="h">Час</option>
                                    <option value="d">Ден</option>
                                    <option value="wk">Седмица</option>
                                    <option value="mo">Месец</option>
                                    <option value="a">Година</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1" style="margin-top: 38px;">
                                <i class="fas fa-cog" onclick="changeMedicationView('2', <?php echo $i ?>)"></i>
                            </div>
                        </div>
                        <div class="form-row ">

                            <div class="form-group col-md-2">
                                <label for="" id="quantityLable<?php echo $i ?>">Количество*</label>
                                <input type="number" min="1" class="form-control" id="quantity<?php echo $i ?>" name="quantity<?php echo $i ?>">
                            </div>

                            <div class="form-group col-md-1" hidden>
                                <label for="medicationForm" id="medicationLable">form ID</label>
                                <input type="text" class="form-control" id="medicationForm<?php echo $i ?>" name="medicationForm<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="">За</label>
                                <input type="text" class="form-control" id="period<?php echo $i ?>" name="period<?php echo $i ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">&nbsp;</label>
                                <select class="form-control" name="" id="">
                                    <option value="1" default>дни</option>
                                    <option value="2">месеца</option>
                                    <option value="3">години</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="medicationName">Указания за приема</label>
                                <input type="text" class="form-control" id="instructionsId<?php echo $i ?>" name="instructions<?php echo $i ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } ?>
    </div>
    <div class="form-row ">
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
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        document.getElementById('morning<?php echo $i ?>').disabled = true;
        document.getElementById('lunch<?php echo $i ?>').disabled = true;
        document.getElementById('evening<?php echo $i ?>').disabled = true;
        document.getElementById('night<?php echo $i ?>').disabled = true;

        document.getElementById('by<?php echo $i ?>').disabled = true;
        document.getElementById('period<?php echo $i ?>').disabled = true;
        document.getElementById('periodfrom<?php echo $i ?>').disabled = true;
    <?php }   ?>

    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#inputPrescriptionDate").datepicker({
        format: "yyyy-mm-dd"
    }).datepicker("setDate", new Date());
</script>