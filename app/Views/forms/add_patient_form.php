<div class="container form-prescription" >
    <?php echo form_open('eprescription/index'); ?>

    <div class="form-row">
        <div class="form-group col-md-12">
            <h4>Лични данни на пациент</h4>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="indentifierTy[e">Тип идентификатор</label>
            <select id="indentifierTy" class="form-control">
                <option value="1" selected>ЕГН</option>
                <option value="2">ЛНЧ</option>
                <option value="3">Социален номер - за чужди граждани</option>
                <option value="4">Номер на паспорт</option>
                <option value="5">Друг идентификатор</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputIdent" id="inputIdentLabel">ЕГН/ЛНЧ/SSN/Паспорт/Друг*</label>
            <input type="text" class="form-control" id="inputIdent" oninput="validateIdentity()" name="inputIdent" value="<?php echo set_value('inputIdent') ?>">
        </div>
        <div class="form-group col-md-2">
            <label for="inputBirthdate">Дата на раждане*</label>
            <input type="text" class="form-control" id="inputBirthdate" name="inputBirthdate" value="<?php echo set_value('inputBirthdate') ?>">
        </div>
        <div class="form-group col-md-1">
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
    </div>

    <div class="form-row">
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

        <div class="form-group col-md-2">
            <label for="inputAddress">Телефон</label>
            <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="<?php echo set_value('inputPhone') ?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="inputCountry">Държава</label>
        <input type="text" class="form-control" id="inputCountry" name="inputCountry" value="<?php echo set_value('inputCountry') ?>" oninput="autocompleteCountry('#inputCountry', '#inputCountryCode')" name="inputCountry">
        </div>
        <div class="form-group col-md-3">
            <label for="inputCountryCode">Код на държава*</label>
            <input type="text" class="form-control" id="inputCountryCode" name="inputCountryCode" value="<?php echo set_value('inputCountryCode') ?>" oninput="autocompleteCountryCode('#inputCountry', '#inputCountryCode')" name="inputCountryCode">
        </div>
        <div class="form-group col-md-5">
            <label for="inputCity">Град*</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity" value="<?php echo set_value('inputCity') ?>" oninput="autocompleteCity('#inputCity', '#inputPostalCode')" name="inputCity">
        </div>
        <!-- <div class="form-group col-md-2">
            <label for="inputPostalCode">Пощенски код</label>
            <input type="text" class="form-control" id="inputPostalCode" name="inputPostalCode" value="<?php echo set_value('inputPostalCode') ?>">
        </div> -->

    </div>
    <div style="margin-top:10px" class="form-group">
        <div class="col-sm-12 controls">
            <button type="submit" class="btn" style="background-color: #456073; color: white;">Запиши</button>
        </div>
    </div>
    </form>