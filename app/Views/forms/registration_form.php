<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form ">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px">Регистрация в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Вход</a></div>
                </div>

                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php } ?>
                <div style="padding-top:30px" class="panel-body" >
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <?php echo form_open('home/login'); ?>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="register-username" type="text" class="form-control" name="username" value="" placeholder="email">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="парола">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="uin" type="text" class="form-control" name="uin" value="" placeholder="УИН/ЛПК">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="rcz" type="text" class="form-control" name="rcz" placeholder="РЦЗ">
                    </div>
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