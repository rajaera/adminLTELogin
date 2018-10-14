<?php
session_start();
if(!isset($_SESSION['reg_user_email'])){
    header("Location: register.php"); /* Redirect browser */
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PomodoroTMS | Registration Success</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition lockscreen">
        <div class="alert alert-success">
                <strong>Registration Success!</strong> 
        </div>
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="#"><b>Pomodoro</b>TMS</a>
            </div>
            <!-- User name -->
            <div class="lockscreen-name" style="color: #007700;">
                <?php 
                    echo $_SESSION['reg_user_email'];
                
                ?>
            </div>


            <div class="box box-widget widget-user lockscreen">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header">
                    <h3 class="widget-user-username"></h3>
                    <h5 class="widget-user-desc">&nbsp;</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="dist/img/reg-success.png" alt="" style="cursor: pointer;">
                </div>
                <div class="box-footer lockscreen" style="border: none;">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="description-block">
                                <h5 class="description-header" style="color: red;">&nbsp;</h5>
                                <div class="help-block text-center" style="color: #007700;">
                                    Your have successfully registered with pomodoro-tms! Confirmation email has been sent to your email account! 
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>


            <div class="text-center">
                <a href="login.php">Sign in</a>
            </div>
            <div class="lockscreen-footer text-center">
                Copyright &copy; <?php echo date('Y'); ;?> <b><a href="#" class="text-black">Eranga Perera</a></b><br>
                All rights reserved
            </div>
        </div>
        <!-- /.center -->

        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
