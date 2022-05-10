<?php
$session = session();
?>

<div class="container form-prescription">
    <?php if (isset($success)) { ?>
        <div class="alert alert-success" style="text-align: center;" role="alert">
            <?php echo $success ?>
        </div>
    <?php } ?>
    <?php echo form_open('patient/edit', 'id="userForm"'); ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <h4>Лични данни на пациент</h4>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="indentifierType">Тип идентификатор</label>
            <select id="indentifierType" name="indentifierType" onchange="emptyForm()" class="form-control">
                <option value="1" <?php echo set_select('indentifierType', '1', TRUE); ?>>ЕГН</option>
                <option value="2" <?php echo set_select('indentifierType', '2',); ?>>ЛНЧ</option>
                <option value="3" <?php echo set_select('indentifierType', '3',); ?>>Социален номер - за чужди граждани</option>
                <option value="4" <?php echo set_select('indentifierType', '4',); ?>>Номер на паспорт</option>
                <option value="5" <?php echo set_select('indentifierType', '5',); ?>>Друг идентификатор</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputIdent" id="inputIdentLabel">ЕГН/ЛНЧ/SSN/Паспорт/Друг*</label>
            <input type="text" class="form-control" id="inputIdent" oninput="validateIdentity()" name="inputIdent" value="<?php if (isset($patient['IDENTIFIER'])) {
                                                                                                                                echo $patient['IDENTIFIER'];
                                                                                                                            } else {
                                                                                                                                echo set_value('inputIdent');
                                                                                                                            } ?>">
            <input type="hidden" name="patientID" value="<?php if (isset($patient['ID'])) {
                                                                echo $patient['ID'];
                                                            } else {
                                                                echo $patientId;
                                                            } ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="inputBirthdate">Дата на раждане*</label>
            <input type="text" class="form-control" id="inputBirthdate" name="inputBirthdate" value="<?php if (isset($patient['BIRTHDATE'])) {
                                                                                                            echo $patient['BIRTHDATE'];
                                                                                                        } else {
                                                                                                            echo set_value('inputBirthdate');
                                                                                                        } ?>">
            <label style="font-size: 0.7em;" for="inputBirthdate">Формат(ГГГГ-ММ-ДД)</label>
        </div>
        <div class="form-group col-md-1">
            <label for="inputGender">Пол*</label>
            <select name="selectGender" id="selectGender" class="form-control">
                <option value="" <?php echo set_select('selectGender', '', TRUE); ?>></option>
                <option value="1" <?php if (isset($patient['GENDER_ID']) && $patient['GENDER_ID'] == 1) {
                                        echo "selected";
                                    } else {
                                        echo set_select('selectGender', '1');
                                    } ?>>Мъж</option>
                <option value="2" <?php if (isset($patient['GENDER_ID']) && $patient['GENDER_ID'] == 2) {
                                        echo "selected";
                                    } else {
                                        echo set_select('selectGender', '2');
                                    } ?>>Жена</option>
            </select>
        </div>
        <!-- <div class="form-group col-md-1">
            <label for="inputAge">Възраст*</label>
            <input type="number" class="form-control" id="inputAge" name="inputAge" value="<?php echo set_value('inputAge') ?>">
        </div> -->
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="inputFName" id="inputFNameLabel">Име*</label>
            <input type="text" class="form-control" id="inputFName" name="inputFName" oninput="validateFirtsName()" value="<?php if (isset($patient['FNAME'])) {
                                                                                                                                echo $patient['FNAME'];
                                                                                                                            } else {
                                                                                                                                echo set_value('inputFName');
                                                                                                                            } ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="inputMName" id="inputMNameLabel">Презиме</label>
            <input type="text" class="form-control" id="inputMName" name="inputMName" oninput="validateMidName()" value="<?php if (isset($patient['MNAME'])) {
                                                                                                                                echo $patient['MNAME'];
                                                                                                                            } else {
                                                                                                                                echo set_value('inputMName');
                                                                                                                            } ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="inputLName" id="inputLNameLable">Фамилия*</label>
            <input type="text" class="form-control" id="inputLName" name="inputLName" oninput="validateLastName()" value="<?php if (isset($patient['LNAME'])) {
                                                                                                                                echo $patient['LNAME'];
                                                                                                                            } else {
                                                                                                                                echo set_value('inputLName');
                                                                                                                            } ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="inputAddress">Телефон</label>
            <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="<?php if (isset($patient['PHONE'])) {
                                                                                                    echo $patient['PHONE'];
                                                                                                } else {
                                                                                                    echo set_value('inputPhone');
                                                                                                } ?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="inputCountry">Държава</label>
            <input type="text" class="form-control" id="inputCountry" name="inputCountry" value="<?php if (isset($patient['gr_name'])) {
                                                                                                        echo $patient['gr_name'];
                                                                                                    } else {
                                                                                                        echo set_value('inputCountry');
                                                                                                    } ?>" oninput="autocompleteCountry('#inputCountry', '#inputCountryCode')" name="inputCountry">
        </div>
        <div class="form-group col-md-3">
            <label for="inputCountryCode">Код на държава*</label>
            <input type="text" class="form-control" id="inputCountryCode" name="inputCountryCode" value="<?php if (isset($patient['gr_name'])) {
                                                                                                                echo $patient['gr_alpha2'];
                                                                                                            } else {
                                                                                                                echo set_value('inputCountryCode');
                                                                                                            } ?>" oninput="autocompleteCountryCode('#inputCountry', '#inputCountryCode')" name="inputCountryCode">
        </div>
        <div class="form-group col-md-5">
            <label for="inputCity">Град*</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity" value="<?php if (isset($patient['CITY'])) {
                                                                                                echo $patient['CITY'];
                                                                                            } else {
                                                                                                echo set_value('inputCity');
                                                                                            } ?>" oninput="autocompleteCity('#inputCity', '#inputPostalCode')" name="inputCity">
        </div>
        <!-- <div class="form-group col-md-2">
            <label for="inputPostalCode">Пощенски код</label>
            <input type="text" class="form-control" id="inputPostalCode" name="inputPostalCode" value="<?php //echo set_value('inputPostalCode') 
                                                                                                        ?>">
        </div> -->

    </div>
    <?php
    if ($session->getflashdata('successfulAdd') != NULL) { ?>
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <?php echo $session->getflashdata('successfulAdd')  ?>
            </div>
        </div>
    <?php }
    if (isset($validation)) { ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $validation->listErrors();  ?>
            </div>
        </div>
    <?php } ?>
    <div class="form-row">
        <div class="col-sm-6 controls">
            <button type="submit" id="submitButton" class="btn" style="background-color: #456073; color: white;">Запиши</button>
        </div>
        <!-- <div class="col-sm-6 controls" style="float: right;">
            <button type="reset" onclick="emptyForm()" class="btn btn-danger float-right">Изчисти</button>
        </div> -->
    </div>
    </form>