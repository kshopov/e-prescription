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
                <div class="form-row">


<div class="form-group col-md-2" style="margin-top: 10px">
    <label for="inputPregnancy">Бременност</label>
    <input type="checkbox" name="inputPregnancy" value="1" <?php echo set_checkbox('inputPregnancy', '1'); ?>>
    <label for="inputBreastfeeding">Кърмене</label>
    <input type="checkbox" name="inputBreastfeeding" value="1" <?php echo set_checkbox('inputBreastfeeding', '1'); ?>>
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