
<div class="container">
    <?php echo form_open('home/register'); ?>
    <div class="row form-prescription" style="margin-top: 50px;">

        <div class="form-group col-md-3">
            <label for="inputFName">Име*</label>
            <input type="fname" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-3">
            <label for="inputMName">Презиме</label>
            <input type="mname" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-3">
            <label for="inputLName">Фамилия*</label>
            <input type="lname" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-3">
            <label for="inputFName">ЕГН/ЛНЧ/SSN/Паспорт/Друг*</label>
            <input type="email" class="form-control" id="inputEmail4">
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputBirthdate">Дата на раждане*</label>
                <input type="text" class="form-control" id="inputBirthdate">
            </div>
            <div class="form-group col-md-2">
                <label for="inputGender">Пол*</label>
                <select id="inputState" class="form-control">
                    <option selected>Мъж</option>
                    <option>Жена</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="inputAge">Възраст*</label>
                <input type="text" class="form-control" id="inputAge">
            </div>
            <div class="form-group col-md-1">
                <label for="inputWeight">Тегло</label>
                <input type="text" class="form-control" id="inputWeight">
            </div>
            <div class="form-group col-md-1">
                <label for="inputPregnant">Бременност</label>
                <select id="inputState" class="form-control">
                    <option selected>Не</option>
                    <option>Да</option>
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="inputBreastfeeding">Кърмене</label>
                <select id="inputState" class="form-control">
                    <option selected>Не</option>
                    <option>Да</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrescrNum">Номер на рец. книжка</label>
                <input type="text" class="form-control" id="inputPrescrNum">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputCountryCode">Код на държавата*</label>
                <input type="text" class="form-control" id="inputCountryCode">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCountry">Държава</label>
                <input type="text" class="form-control" id="inputcountry">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCity">Град*</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Адрес</label>
                <input type="text" class="form-control" id="inputAddress">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPostalCode">Пощенски код</label>
                <input type="text" class="form-control" id="inputPostalCode">
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
        format: 'dd/mm/yyyy'
    });
    $('#inputBirthdate').datepicker('setDate', new Date());
</script>