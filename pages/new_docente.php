<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$user = new USER();
$object = new USER();

$show_mensaje= "none";
$show_mensaje_err= "none";

if(isset($_POST['btn-signup']))
{
    $cc = strip_tags($_POST['cc']);
    $nombres = strip_tags($_POST['name']);
    $prim_apellido = strip_tags($_POST['pri_apellido']);
    $seg_apellido = strip_tags($_POST['seg_apellido']);   
    $email = strip_tags($_POST['email']);
    $pass = strip_tags($_POST['password']);

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
            if($user->register_docente($cc,$nombres,$prim_apellido,$seg_apellido,$email,$pass))
            {  
                $show_mensaje= "show";
            }
        }
    }
    catch(PDOException $e)
    {
        $show_mensaje= "show";
    } 
}

 ?>



    <!-- Top Bar -->
    <?php include("../includes/header.php");?>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php include("../includes/menu.php");?>
    <!-- end menu-->

    <section class="content">
        <div class="container-fluid">

            <!-- Page -->
            <!-- Basic Validation -->

            <!-- Mensaje Buen-->
            <div class="alert alert-success" style="display: <?php echo $show_mensaje; ?>;">
                <strong>Well done!</strong> Usuario creado correctamente.
            </div>

            <script>jQuery(function(){swal(\"¡El Número de Identificación $num_id ya se encuentra registrado en la Asignatura $idio.!\", \"Por favor rectificar los datos ingresados.\", \"error\");});</script>
            
            <!-- end Mensaje Buen-->

            <!-- Mensaje Mal-->
            <div class="alert alert-warning" style="display: <?php echo $show_mensaje_err; ?>;">
                <strong>Bad done!</strong> CC de usuario ya inscrita.
            </div>
            <!-- end Mensaje Mal-->


            <!-- Lista de Docentes -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Docentes <small>Lista de docentes</small>
                            </h2>
                        </div>
                        <div class="body">
                                <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Identificación </th>
                                                            <th>Nombres</th>
                                                            <th>Apellidos</th>
                                                            <th>Email</th>
                                                            <th>Tipo Usuario</th>
                                                            <th>Sede Educativa</th>
                                                            <th>Actualizar</th>
                                                            <th>Borrar</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $users = $object->Read_docente();
                                 
                                if (count($users) > 0) {
                        
                                    foreach ($users as $user) {
                                        $data .= '<tr>
                                                <td>' . $user['id_docente'] . '</td>
                                                <td>' . $user['nombres'] . '</td>
                                                <td>' . $user['prim_apellido'] . ' ' .$user['seg_apellido'] .'</td>
                                                <td>' . $user['email'] . '</td>
                                                <td>' . $user['id_tipo_usuario'] . '</td>
                                                <td>' . $user['docentecol'] . '</td>
                                                <td>
                                                    <button onclick="GetUserDetails(' . $user['id_docente'] . ')" class="btn btn-warning">Actualizar</button>
                                                </td>
                                                <td>
                                                    <button onclick="DeleteUser(' . $user['id_docente'] . ')" class="btn btn-danger">Borrar</button>
                                                </td>
                                            </tr>';
                                        
                                    }
                                } else {
                                    // records not found
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }
                                 
                                $data .= '<tbody></table>';
                                 
                                echo $data;
                                 
                            ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Lista Docentes -->


            <!-- Advanced Form Example With Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>NUEVO DOCENTE</h2>
                        </div>
                        <div class="body">
                            <form id="wizard_with_validation" method="POST">
                                <h3>Informacion de Cuenta</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" required>
                                            <label class="form-label">CC*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password" required>
                                            <label class="form-label">Contraseña*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="confirm" required>
                                            <label class="form-label">Confirm Contraseña*</label>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Informacion Perfil</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" required>
                                            <label class="form-label">Nombres*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="surname" class="form-control" required>
                                            <label class="form-label">Primer Apellido*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="surname2" class="form-control" required>
                                            <label class="form-label">Segundo Apellido*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" required>
                                            <label class="form-label">Email*</label>
                                        </div>
                                    </div>
                                <fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
            

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->