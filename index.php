<?php
session_start();
require_once("pages/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('pages/index.php');
}


if(isset($_POST['btn-login']))
{
	$u_id = strip_tags($_POST['u_id']);
	$u_pass = strip_tags($_POST['u_pass']);
		
	if($login->doLogin($u_id,$u_pass))
	{
        echo $login->doLogin($u_id,$u_pass);

		$login->redirect('pages/index.php');
	}
	else
	{
		$error = "Datos Incorrectos!";
	}	
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>NotaApp - Administrador de Calificaciones</title>
    
    <!-- Favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="images/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="images/favicon/manifest.json">
    <link rel="mask-icon" href="images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="NotaApp">
    <meta name="application-name" content="NotaApp">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link href="css/google-fonts.css" rel="stylesheet" type="text/css">
    <link href="css/google-material-icons.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">NotaAPP</a>
            <small>Aministrador de Calificaciones</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Logueate para iniciar sesion</div>

                    <!--Error -->
                    <div id="error">
                    <?php
                        if(isset($error))
                        {
                            ?>
                            <div class="alert alert-danger">
                               <i class="material-icons">error_outline</i><?php echo $error; ?>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                    <!-- end error-->

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="u_id" placeholder="CC" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="u_pass" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-teal waves-effect" type="submit" name="btn-login">INICIAR</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.php">Registrarse!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>