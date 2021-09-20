<div class="container">


    <?php
        if(empty($prescriptions)) {?>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6" style="margin-top: 50px; padding-bottom: 10px;  border-radius: 6px; border-color: grey;">
            <div class="alert alert-danger alert-dismissible fade show" role="alert"style="text-align: center;">
                <strong >Не успяхме да намерим рецептата, която търсите!</strong> 
            </div>
            <div class="col-3"></div>
        </div>
    </div>
        <?php
        } else {
    ?>
    <div class="row">
        <div class="col-12" style="margin-top: 50px; padding-bottom: 10px; border:1px solid; border-radius: 6px; border-color: grey;">
            <h3 style="text-align: center;" id="medtag">Данни за рецептата</h3>
            <b>Пациент:</b>
            <?php echo $prescriptions[0]['FNAME'] . ' ' . $prescriptions[0]['LNAME']; ?><br>
            <b>Град: </b>
            <?php echo $prescriptions[0]['CITY'];
            ?><br>
            <b>Издадена на: </b>
            <?php echo $prescriptions[0]['DATE'];
            ?><br>
            <b>НРН: </b>
            <?php echo $prescriptions[0]['NRN']; ?><br>
            <hr>
            <?php
            for ($i = 0; $i < count($prescriptions); $i++) {
            ?>
                <div class="row">
                    <div class="col-md-3">
                    <p><b><?php echo $prescriptions[$i]['NAME'] ?></b></p>
                        <ul style="padding-left: 20px;">
                            <li><p><?php echo $prescriptions[$i]['KOLICHESTVO'] ?></p></li>
                            <li><p><?php echo $prescriptions[$i]['DOZA'] ?> за <?php echo $prescriptions[$i]['duration'] . ' ' . $prescriptions[$i]['PERIOD_UNIT'] ?></p></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php
            ?>
            <hr>
            <?php
            }
            ?>
        </div>
    </div>
    <?php } ?>
</div>