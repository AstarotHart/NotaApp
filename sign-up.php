<?php
session_start();
require_once('pages/class.user.php');
$user = new USER();
$object = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('index.php');
}

$show_mensaje= "none";
$show_mensaje_err= "none";

if(isset($_POST['btn-signup']))
{
    $cc = strip_tags($_POST['cc']);
    $nombres = strip_tags($_POST['nombres']);
    $prim_apellido = strip_tags($_POST['primer_apellido']);
    $seg_apellido = strip_tags($_POST['segundo_apellido']);   
    $email = strip_tags($_POST['email']);
    $pass = strip_tags($_POST['password']);
    $sede = strip_tags($_POST['sede']);

    try
    {
        $stmt = $user->runQuery("SELECT id_docente FROM docente WHERE id_docente=:id_docente");
        $stmt->execute(array(':id_docente'=>$cc));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
        if($row['id_docente']==$cc) 
        {
            $show_mensaje_err= "show";
        }
        else
        {
            if($user->register_docente($cc,$nombres,$prim_apellido,$seg_apellido,$email,$pass,$sede))
            {  
                $user->redirect('index.php');
            }
        }
    }
    catch(PDOException $e)
    {
        $show_mensaje= "show";
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
    <link rel="icon" href="favicon.ico" type="image/x-icon">

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

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">NotaAPP</a>
            <small>Aministrador de Calificaciones</small>
        </div>
        <div class="card">
            <div class="body">

				<!-- Mensaje Mal-->
	            <div class="alert alert-warning" style="display: <?php echo $show_mensaje_err; ?>;">
	                <i class="material-icons">error_outline</i> CC de usuario ya inscrita.
	            </div>
	            <!-- end Mensaje Mal-->
			


                <form id="sign_up" method="POST">
                    <div class="msg">Registrate</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">fingerprint</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="cc" placeholder="CC" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nombres" placeholder="Nombres" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">perm_identity</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="primer_apellido" placeholder="Primer Apellido" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">perm_identity</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="segundo_apellido" placeholder="Segundo Apellido" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Correo Electronico" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">business</i>
                        </span>
                        <div class="form-line">
                            <select class="form-control show-tick" name="sede">
                                        <option value="">-- Seleccione Sede --</option>
                                        <option value="Instituto_Estrada">Instituto Estrada</option>
                                        <option value="Juan_Jose_Rondon">Juan Jose Rondon</option>
                                        <option value="Mariscal_Sucre">Mariscal Sucre</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" placeholder="Confirmar Contraseña" required>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="btn-signup">Registrar</button>

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
    <script src="js/pages/examples/sign-up.js"></script>
</body>

</html>