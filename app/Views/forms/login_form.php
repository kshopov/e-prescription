<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px">Вход в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Забравена
                            парола?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body">
                    <?php echo form_open('home/index'); ?>

                    <?php if (session()->get('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    <?php } ?>

                    <div>
                        <label for="email" style="margin-bottom: -10px">Email</label>
                        <input id="login-username" type="text" class="form-control" name="email" value="">
                    </div>

                    <div style="margin-bottom: 25px">
                        <label for="password" style="margin-bottom: -10px">Парола</label>
                        <input id="login-password" type="password" class="form-control" name="password">
                    </div>

                    <?php
                    if (isset($validation)) { ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?php echo $validation->listErrors(); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn" style="background-color: #456073; color: white">Вход</button>
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