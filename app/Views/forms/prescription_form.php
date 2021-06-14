<?php
    use Ramsey\Uuid\Uuid;
    $myuuid = Uuid::uuid4();
?>
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
            <input type="text" class="form-control" id="inputFName" name="inputFName" value="<?php echo set_value('inputFName') ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="inputMName">Презиме</label>
            <input type="text" class="form-control" id="inputMName" name="inputMName" value="<?php echo set_value('inputMName') ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="inputLName">Фамилия*</label>
            <input type="text" class="form-control" id="inputLName" name="inputLName" value="<?php echo set_value('inputLName') ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="inputIdent">ЕГН/ЛНЧ/SSN/Паспорт/Друг*</label>
            <input type="text" class="form-control" id="inputIdent" oninput="autcompleteUserData('#inputIdent')" name="inputIdent" value="<?php echo set_value('inputIdent') ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputBirthdate">Дата на раждане*</label>
                <input type="text" class="form-control" id="inputBirthdate" name="inputBirthdate" value="<?php echo set_value('inputBirthdate') ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="inputGender">Пол*</label>
                <select name="selectGender" id="selectGender" class="form-control">
                    <option value="" <?php echo set_select('selectGender', '', TRUE); ?>></option>
                    <option value="1" <?php echo set_select('selectGender', '1'); ?>>Мъж</option>
                    <option value="2" <?php echo set_select('selectGender', '2'); ?>>Жена</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="inputAge">Възраст*</label>
                <input type="number" class="form-control" id="inputAge" min="0" max="120" name="inputAge" value="<?php echo set_value('inputAge') ?>">
            </div>
            <div class="form-group col-md-1">
                <label for="inputWeight">Тегло</label>
                <input type="number" class="form-control" id="inputWeight" name="inputWeight" value="<?php echo set_value('inputWeight') ?>">
            </div>
            <div class="form-group col-md-2" style="margin-top: 10px">
                <label for="inputPregnancy">Бременност</label>
                <input type="checkbox" name="inputPregnancy" value="1" <?php echo set_checkbox('inputPregnancy', '1'); ?>>
                <label for="inputBreastfeeding">Кърмене</label>
                <input type="checkbox" name="inputBreastfeeding" value="1" <?php echo set_checkbox('inputBreastfeeding', '1'); ?>>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrescrNum">Номер на рец. книжка</label>
                <input type="text" class="form-control" id="inputPrescrNum" name="inputPrescrNum" value="<?php echo set_value('inputPrescrNum') ?>">
            </div>
        </div>
            <div class="form-group col-md-2">
                <label for="inputCountryCode">Код на държавата*</label>
                <input type="text" class="form-control" id="inputCountryCode" name="inputCountryCode" value="<?php echo set_value('inputCountryCode') ?>" oninput="autocompleteCountryCode('#inputCountry', '#inputCountryCode')" name="inputCountryCode">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCountry">Държава</label>
                <input type="text" class="form-control" id="inputCountry" name="inputCountry" value="<?php echo set_value('inputCountry') ?>" oninput="autocompleteCountry('#inputCountry', '#inputCountryCode')" name="inputCountry">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCity">Град*</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" value="<?php echo set_value('inputCity') ?>" oninput="autocompleteCity('#inputCity', '#inputPostalCode')" name="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Адрес</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="<?php echo set_value('inputAddress') ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPostalCode">Пощенски код</label>
                <input type="text" class="form-control" id="inputPostalCode" name="inputPostalCode" value="<?php echo set_value('inputPostalCode') ?>">
            </div>
            <!--
           ** КРАЙ НА ПОТРЕБИТЕЛСКИТЕ ДАННИ **
            -->
            <!--
                ** ОТ ТУК ЗАПОЧВА РЕЦЕПТАТА **
            -->
            <div class="form-group col-md-12">
                <h4 id="medtag">Рецепта</h4>
            </div>
            <input type="hidden" class="form-control" id="inputLRN" name="inputLRN" value="<?php echo $myuuid->toString() ?>">
            <div class="form-group col-md-2">
                <label for="inputPrescriptionDate">Дата*</label>
                <input type="text" class="form-control" id="inputPrescriptionDate" name="inputPrescriptionDate" disabled> 
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-md-3" style="margin-top: 30px">
                        <input type="checkbox" id="inputDispansationType" name="inputDispansationType"  onclick="enableInputNumbers()">
                        <label for="inputDispansationType">Многократно за</label>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 20px">
                        <!--
                        това поле трябва да се показва само, ако е избрана опция за многократна употреба
                        в този случай трябва да се избере брой изпълнения на рецептата като 0 се приема за неограничен -->
                        <input type="number" class="form-control" id="inputRepeatsNumber" name="inputRepeatsNumber" disabled>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 30px">
                        <label for="inputDispansationType">отпускания</label>
                    </div>
                </div>
            </div>
            <div id="medicationParent" class="form-group col-md-12 ">
                <div id="medication" class="row">
                    <div class="form-group col-md-1">
                        <label for="seqId">№</label>
                        <input type="text" class="form-control" id="seqId" name="seqId" value="1" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="medicationName">Лекарствен продукт</label>
                        <input type="text" class="form-control" id="medicationName" name="medicationName[0]" oninput="autocompleteMedicationName('#medicationName', '#medicationIdentifier', '#medicationForm')">
                    </div>
                    <input type="hidden" class="form-control" id="medicationForm" name="medicationForm">

                    <div class="form-group col-md-2">
                        <label for="medicationName">Колко пъти</label>
                        <input type="number" class="form-control" id="medication" name="medicationName[0]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="medicationName">По колко</label>
                        <input type="number" class="form-control" id="medicationName" name="medicationName[0]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="medicationForm">Мерна единица</label>
                        <select class="form-control" name="medicationForm" id="medicationFormId">
                            <option value="" default></option>
                            <option value="">eqweq</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="instructionsNote">Указания за прием</label>
                        <textarea rows="1" class="form-control" id="instructionsNote" name="instructionsNote"> </textarea>
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
    <!-- <button onclick="appendMedication()">Добави медикамент</button> -->
</div>

<script type="text/javascript">
    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#inputPrescriptionDate").datepicker({
        format: "yyyy-mm-dd"
    }).datepicker("setDate", new Date());
</script>