<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px; font-size: 1.6rem;">Въведете нова парола</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-30px"><a href="/">Вход</a></div>
                </div>
                <?php if (isset($password_reset_status)) { ?>
                    <div class="alert alert-success" style="margin-top: 20px; margin-bottom: -20px;" role="alert">
                        <p><?php echo $password_reset_status; ?></p>
                    </div>
                <?php } ?>
                <div style="padding-top:30px" class="panel-body">
                    <?php echo form_open('user/setNewPassword', 'id="set-new-password-form"'); ?>
                    <!-- Start of form -->
                    <div>
                        <input id="reset-token" type="hidden" class="form-control" name="token" value="<?php echo $token; ?>">
                    </div>
                    <div>
                        <label for="password" style="margin-bottom: -10px; font-size: 0.9rem">Парола*</label>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="">
                    </div>
                    <div>
                        <label for="password_confirm" style="margin-bottom: -10px; font-size: 0.9rem">Потвърди паролата*</label>
                        <input id="login-password" type="password" class="form-control" name="password_confirm" placeholder="">
                    </div>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert" id="#errorsDiv" hidden>
                            <div class="inner"></div>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn" id="send-btn" style="background-color: #456073; color: white">Изпрати
                            </button>
                        </div>
                    </div>
                    </form>
                    <!-- End of form -->
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Нямате акаунт!
                                <a href="/register">
                                    Регистрирайте се
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>