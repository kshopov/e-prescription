<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form ">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px">Регистрация в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Вход</a></div>
                </div>
                <div style="padding-top:30px" class="panel-body" >
                    <?php echo form_open('home/register'); ?>
                    <div>
                        <label for="rcz" style="margin-bottom: -10px">РЦЗ*</label>
                        <input id="rcz" type="text" class="form-control" name="rcz" value="<?= set_value('rcz') ?>" placeholder="">
                    </div>
                    <div>
                        <label for="uin" style="margin-bottom: -10px">УИН*</label>
                        <input id="uin" type="text" class="form-control" name="uin" value="<?= set_value('uin') ?>" placeholder="">
                    </div>
                    <div>
                        <label for="email" style="margin-bottom: -10px">Email*</label>
                        <input id="register-username" type="text" class="form-control" name="email" value="<?= set_value('email') ?>" placeholder="">
                    </div>
                    <div>
                        <label for="email" style="margin-bottom: -10px">Телефон*</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="<?= set_value('phone') ?>">
                        <small>(Валидни формати: +359885123456, 35932123456, 0885123456, 032252525)</small>​

                    </div>
                    <div>
                        <label for="password" style="margin-bottom: -10px">Парола*</label>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="">
                    </div>
                    <div>
                        <label for="confirm_passowrd" style="margin-bottom: -10px">Потвърди паролата*</label>
                        <input id="login-password" type="password" class="form-control" name="password_confirm" placeholder="">
                    </div>
                    <?php
                    if (isset($validation)) { ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?php echo $validation->listErrors();  ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn" style="background-color: #456073; color: white">Регистрирай се </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col"></div>
    </div>
</div>