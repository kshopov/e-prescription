<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px; font-size: 1.6rem;">Забравена парола</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-30px"><a href="/">Вход</a></div>
                </div>
                <?php if (isset($successful_registration)) { ?>
                    <div class="alert alert-success" style="margin-top: 20px; margin-bottom: -20px;" role="alert">
                        <p><?php echo $successful_registration; ?></p>
                    </div>
                <?php } else if (isset($notsuccessful_registration)) { ?>
                    <div class="alert alert-danger" style="margin-top: 20px; margin-bottom: -20px;" role="alert">
                        <p><?php echo $notsuccessful_registration; ?></p>
                    </div>
                <?php } ?>
                <div style="padding-top:30px" class="panel-body">
                    <?php echo form_open('user/passwordReset', 'id="login-form"'); ?>
                    <?php if (session()->get('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    <?php } ?>
                    <div>
                        <label for="email" style="margin-bottom: -10px; font-size: 0.9rem;">Email</label>
                        <input id="login-username" type="text" class="form-control" name="email" value="">
                    </div>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert" id="#errorsDiv" hidden>
                            <div class="inner"></div>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn" id="submitButton" style="background-color: #456073; color: white">Изпрати
                            </button>
                        </div>
                    </div>
                    </form>
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

<script>
    $(document).ready(function() {
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Моля, въведете валиден email адрес",
                    email: "Моля, въведете валиден email адрес"
                }
            }
        });
    });
</script>