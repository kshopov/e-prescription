<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col-md-3 col-lg-4"></div>
        <div class="col-md-6 col-lg-4" style="background-color: #e3f2fd;">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title" style="margin-top: 10px">Вход в E-рецепта</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Забравена парола?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="email">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="парола">
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <a id="btn-login" href="#" class="btn" style="background-color: #456073; color: white">Вход </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    Нямате акаунт!
                                    <a href="#">
                                        Регистрирайте се
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-4"></div>
    </div>
</div>