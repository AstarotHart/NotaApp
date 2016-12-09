<?php 
if (isset($_POST['actualizar'])) 
{
    $id_docente=$user_id;
    $nombres=$_POST['nombres'];
    $p_apellido=$_POST['p_apellido'];
    $s_apellido=$_POST['s_apellido'];
    $email=$_POST['email'];

    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];

    $fullUrl=$host.$url;

    /**
     * Llamada a funcion para actualizar los datos del docente
     */
    if(($user_app->update_docente($id_docente,$nombres,$p_apellido,$s_apellido,$email))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Datos Actualizados","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Datos NO Actualizados","","error");';
        echo '}, 1000);</script>';
     }

}

if (isset($_POST['cambiar_pass']))
{
    $id_docente=$user_id;
    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];

    /**
     * Llamada a funcion para cambiar la  contraseniadel docente
     */
    if(($user_app->cambiar_pass_docente($id_docente,$old_password,$new_password))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Contraseña Actualizada","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Contraseña NO Actualizada","","error");';
        echo '}, 1000);</script>';
     }
}
 ?>

<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" ><?php echo $user->nombres." ".$user->prim_apellido; ?></div>
                    <div class="email"><?php echo $user->email; ?></div>
                    <div class="email"><?php echo $user_type->des_tipo_usuario; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a data-toggle="modal" data-target="#Actu_Datos"><i class="material-icons">person</i>Actualizar Datos</a></li>
                            <li><a data-toggle="modal" data-target="#New_Pass"><i class="material-icons">lock</i>Nueva Contraseña</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="logout.php?logout=true"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">

                <?php
                    function isSite()
                    {
                        $url = $_SERVER['PHP_SELF'];
                        $sites = func_get_args();
                        foreach($sites as $site)
                        {
                            if(strpos($url, $site)) return true;
                        }
                        return false;
                    }
                ?>

                <ul class="list">
                    <li class="header">Menú Principal</li>
                    <li <?php if (isSite('index.php')) echo 'class="active"'; ?>>
                        <a href="../pages/index.php">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li <?php if (isSite('new_docente.php', 'new_alumno.php','new_acudiente.php' )) echo 'class="active"'; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_add</i>
                            <span>Nuevo</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if (isSite('new_docente.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_docente.php">Docente</a>
                            </li>
                            <li <?php if (isSite('new_alumno.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_alumno.php">Alumno</a>
                            </li>
                            <li <?php if (isSite('new_acudiente.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_acudiente.php">Acudiente</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="header">Otro Menú</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">NotaApp</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

        <!-- Modal Actualizar Datos Usuario -->
            <div class="modal fade" id="Actu_Datos" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Datos</h4>
                        </div>
                        <div class="modal-body">
                            <form id="sign_up" method="POST">
                        
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombres" value="<?php echo $user->nombres; ?>" required autofocus>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">perm_identity</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="p_apellido" value="<?php echo $user->prim_apellido; ?>" required autofocus>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">perm_identity</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="s_apellido" value="<?php echo $user->seg_apellido; ?>" required autofocus>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>" required>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="actualizar">Actualizar</button>
                                    <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        

        <!-- Modal Cambiar contrasena -->
            <div class="modal fade" id="New_Pass" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Datos</h4>
                        </div>
                        <div class="modal-body">
                            <form id="sign_up" method="POST">
                        
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="old_password" placeholder="Contraseña Antigua" required>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="new_password" placeholder="Nueva Contraseña" required>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="confirm" placeholder="Confirmar Nueva Contraseña" required>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="cambiar_pass">Cambiar</button>
                                    <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>


    </section>