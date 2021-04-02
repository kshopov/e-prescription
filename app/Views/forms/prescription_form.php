
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
            </div>
            <div class="form-row" id="medication">
                <label for="inputLRN">LRN*</label>
                <input type="text" class="form-control" id="inputLRN" name="inputLRN" disabled>
            </div>
        </div>
    </div>
    <div style="margin-top:10px" class="form-group">
        <div class="col-sm-12 controls">
            <button type="submit" class="btn" style="background-color: #456073; color: white;">Запиши</button>
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    $('#inputBirthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#inputPrescriptionDate").datepicker({
        format: "yyyy-mm-dd"
    }).datepicker("setDate", new Date());
</script>