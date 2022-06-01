<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col"></div>
        <div class="col-5 form">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px; font-size: 1.6rem;">Вход в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-30px"><a href="/user/passwordReset">Възстановяване на
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
                    <?php echo form_open('home/index'); ?>

                    <?php if (session()->get('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    <?php } ?>
                    <div>
                        <label for="email" style="margin-bottom: -10px; font-size: 0.9rem;">Въведете Email</label>
                        <input id="login-username" type="text" class="form-control" name="email" value="">
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

<script>
    $(document).ready(function() {
        alert("Hey");

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
            submitHandler: function(form, e) {
                e.preventDefault();

                let frmData = $("#login-form").serializeArray();
                $.ajax({
                    type: "POST",
                    url: '/home/ajaxLogin',
                    dataType: "json",
                    data: frmData,
                    success: function(data) {
                        if (data['success']) {
                            $.ajax({
                                type: "POST",
                                url: '/his/getchallenge',
                                dataType: "text",
                                success: function(data) {
                                    console.log(data);
                                    if (!data.length) {
                                        alert('Не се получава отговор от his.bg за взимане на challenge');
                                        //location.href = '/home/logout';
                                    }
                                    SCS.signXML(data)
                                        .then(function(json) {
                                            //document.getElementById('result').value = JSON.stringify(json);
                                            let signedChallenge = SCS.Base64Decode(json.signature);
                                            $.ajax({
                                                type: "POST",
                                                url: '/his/gettoken',
                                                dataType: "text",
                                                data: {
                                                    "xml": signedChallenge
                                                },
                                                success: function(data) {
                                                    let tokenXML = data;
                                                    alert(tokenXML);
                                                    $.ajax({
                                                        type: "POST",
                                                        url: '/his/savetoken',
                                                        dataType: "text",
                                                        data: {
                                                            "tokenData": tokenXML
                                                        },
                                                        success: function(data) {
                                                            console.log(data);
                                                            location.href = '/eprescription/index';
                                                        },
                                                        error: function(error) {
                                                            alert('Проблем при записване на тоукен: ' + error.message);
                                                            console.log(error);
                                                            location.href = '/eprescription/index';
                                                            //location.href = '/home/logout';
                                                        }
                                                    })
                                                },
                                                error: function(error) {
                                                    console.log(error);
                                                    alert('Проблем при взимане на тоукен: ' + error.message);
                                                    location.href = '/home/logout';
                                                }
                                            })
                                        })
                                        .then(null, function(error) {
                                            alert('Проблем при подписване: ' + error.message);
                                            //location.href = '/home/logout';
                                        });
                                },
                                error: function(error) {
                                    console.log(error);
                                    location.href = '/home/logout';
                                }
                            })

                        } else if (data['errors']) {
                            $(".errors").remove();

                            document.getElementById('#errorsDiv').hidden = false;
                            $(".inner").append(data['errors']);
                        }
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    }
                });
            }
        });
    });
</script>