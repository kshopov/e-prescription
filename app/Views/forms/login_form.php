<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px; font-size: 1.6rem;">Вход в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-30px"><a href="#">Забравена
                            парола?</a></div>
                </div>
                <?php if (isset($successful_registration)) { ?>
                <div class="alert alert-success" style="margin-top: 20px; margin-bottom: -20px;" role="alert">
                    <p><?php echo $successful_registration; ?></p>
                </div>
                <?php } else if(isset($notsuccessful_registration)) { ?>
                <div class="alert alert-danger" style="margin-top: 20px; margin-bottom: -20px;" role="alert">
                    <p><?php echo $notsuccessful_registration; ?></p>
                </div>
                <?php } ?>
                <div style="padding-top:30px" class="panel-body">
                    <?php echo form_open('home/index', 'id="login-form"'); ?>
                    <?php if (session()->get('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    <?php } ?>
                    <div>
                        <label for="email" style="margin-bottom: -10px; font-size: 0.9rem;">Email</label>
                        <input id="login-username" type="text" class="form-control" name="email" value="">
                    </div>
                    <div style="margin-bottom: 25px">
                        <label for="password" style="margin-bottom: -10px; font-size: 0.9rem;">Парола</label>
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
                            <button type="submit" class="btn" id="submitButton" style="background-color: #456073; color: white">Вход</button>
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



<!-- <script>
    (function () {
        $('#text-sign').on('click', function (e) {
            e.preventDefault();
            var val = document.getElementById('login-username').value;
            if (!val.length) {
                return alert('Не сте въвели текст за подписване');
            }
            SCS.sign(val)
                .then(function (json) {
                    document.getElementById('result').value = JSON.stringify(json);
                })
                .then(null, function (err) {
                    document.getElementById('result').value = 'ERROR:' + "\r\n" + err.message;
                });
        });
        $('#xml-sign').on('click', function (e) {
            e.preventDefault();
            var val = document.getElementById('xml').value;
            if (!val.length) {
                return alert('Не сте въвели XML за подписване');
            }
            SCS.signXML(val)
                .then(function (json) {
                    //document.getElementById('result').value = JSON.stringify(json);
                    document.getElementById('result').value = SCS.Base64Decode(json.signature);
                })
                .then(null, function (err) {
                    document.getElementById('result').value = 'ERROR:' + "\r\n" + err.message;
                });
        });
        $('#file-sign').on('click', function (e) {
            e.preventDefault();
            var files = document.getElementById('file').files;
            if (!files.length) {
                return alert('Не сте избрали файл за подписване');
            }
            var reader = new FileReader();
            reader.onloadend = function (e) {
                SCS.sign(e.target.result)
                    .then(function (json) {
                        document.getElementById('result').value = JSON.stringify(json);
                    })
                    .then(null, function (err) {
                        document.getElementById('result').value = 'ERROR:' + "\r\n" + err.message;
                    });
            };
            reader.readAsText(files[0]);
        });
        $('#pick-sign').on('click', function (e) {
            e.preventDefault();
            SCS.signFile()
                .then(function (json) {
                    document.getElementById('result').value = JSON.stringify(json);
                })
                .then(null, function (err) {
                    document.getElementById('result').value = 'ERROR:' + "\r\n" + err.message;
                });
        });
    }());
    $('#menu a').click(function (e) {
        e.preventDefault();
        var i = $(this).siblings().removeClass('selected').end().addClass('selected').index();
        $('form').hide().eq(i).show();
    });
    $('form').submit(false);
    </script> -->