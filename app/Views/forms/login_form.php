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
                <?php } else if (isset($notsuccessful_registration)) { ?>
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
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert" id="#errorsDiv" hidden>
                                <div class="inner"></div>
                            </div>
                        </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn" id="submitButton"
                                    style="background-color: #456073; color: white">Вход
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
                },
                password: "required"
            },
            messages: {
                email: {
                    required: "Моля, въведете валиден email адрес",
                    email: "Моля, въведете валиден email адрес"
                },
                // password: "Моля, въведете валидна парола"
            },
            submitHandler: function (form, e) {
                e.preventDefault();

                let frmData = $("#login-form").serializeArray();
                $.ajax({
                    type: "POST",
                    url: "/home/ajaxLogin",
                    dataType: "json",
                    data: frmData,
                    success: function (data) {
                        if(data['success'])  {
                            $.ajax({
                                type: "POST",
                                url: "/his/getchallenge",
								//url: "https://ptest-auth.his.bg/token",
                                dataType : "text",
                                success: function (data) {
                                    console.log(data);
									if (!data.length) {
										return alert('Не сте въвели текст за подписване');
									}
									SCS.signXML(data)
										.then(function (json) {
											//document.getElementById('result').value = JSON.stringify(json);
											let signedXml = SCS.Base64Decode(json.signature);
											$.ajax({
												type: "POST",
												url: "/his/gettoken",
												dataType: "xml",
												data: signedXml,
												success: function(data) {
													$.ajax({
														type: "POST",
														url: "his/savetoken",
														dataType: "json",
														data: data,
														success: function(data) {
															console.log(data);
														},
														error: function(error) {
															console.log(error);
														}
													})
													//location.href = '<?php echo base_url().'/eprescription/index'; ?>'
												},
												error: function(error) {
													console.log(error);
													alert('Проблем при взимане на тоукент: ' + error.message);
												}
											})
										})
										.then(null, function (error) {
											alert('Проблем при подписване: ' + error.message);
											location.reload();
										});
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            })
                            
                        } else if (data['errors']) {
                            $(".errors").remove();

                            document.getElementById('#errorsDiv').hidden = false;
                            $(".inner").append(data['errors']);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

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