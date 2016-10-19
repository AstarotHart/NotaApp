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
    $ti = strip_tags($_POST['ti']);
    $nombres = strip_tags($_POST['name']);
    $prim_apellido = strip_tags($_POST['pri_apellido']);
    $seg_apellido = strip_tags($_POST['seg_apellido']);   
    $id_acudiente = strip_tags($_POST['Id_acudiente']);
    $id_grado = strip_tags($_POST['Id_grado']);
    $id_grupo = strip_tags($_POST['Id_grupo']);

    try
    {
        $stmt = $user->runQuery("SELECT id_alumno FROM alumno WHERE id_alumno=:id_alumno");
        $stmt->execute(array(':id_alumno'=>$ti));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
        if($row['id_alumno']==$ti) 
        {
            $show_mensaje_err= "show";
        }
        else
        {
            if($user->register_alumno($ti,$nombres,$prim_apellido,$seg_apellido,$id_acudiente,$id_grado,$id_grupo))
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
            <div class="alert alert-sutiess" style="display: <?php echo $show_mensaje; ?>;">
                <strong>Well done!</strong> Usuario creado correctamente.
            </div>
            <!-- end Mensaje Buen-->

            <!-- Mensaje Mal-->
            <div class="alert alert-warning" style="display: <?php echo $show_mensaje_err; ?>;">
                <strong>Bad done!</strong> ti de usuario ya inscrita.
            </div>
            <!-- end Mensaje Mal-->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>
                                Alumnos <small>Lista de alumnos</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="material-icons">loop</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="body">

                        <!-- LISTAR ALUMNOS -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>id_alumno</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Id Acudiente</th>
                                                            <th>Id Grado</th>
                                                            <th>Id Grupo</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    <thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>id_alumno</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Id Acudiente</th>
                                                            <th>Id Grado</th>
                                                            <th>Id Grupo</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $users = $object->Read_alumno();
                                 
                                if (count($users) > 0) {
                                    $number = 1;
                                    foreach ($users as $user) {
                                        $data .= '<tr>
                                                <td>' . $number . '</td>
                                                <td>' . $user['id_alumno'] . '</td>
                                                <td>' . $user['nombres'] . '</td>
                                                <td>' . $user['prim_apellido'] . '</td>
                                                <td>' . $user['seg_apellido'] . '</td>
                                                <td>' . $user['id_acudiente'] . '</td>
                                                <td>' . $user['id_grado'] . '</td>
                                                <td>' . $user['id_grupo'] . '</td>
                                                <td>
                                                    <button onclick="GetUserDetails(' . $user['id_alumno'] . ')" class="btn btn-warning">Update</button>
                                                </td>
                                                <td>
                                                    <button onclick="DeleteUser(' . $user['id_alumno'] . ')" class="btn btn-danger">Delete</button>
                                                </td>
                                            </tr>';
                                        $number++;
                                    }
                                } else {
                                    // records not found
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }
                                 
                                $data .= '<tbody></table>';
                                 
                                echo $data;
                                 
                            ?>
                        <!-- #LISTAR ALUMNOS -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>NUEVO ALUMNO</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ti" required>
                                        <label class="form-label">Ti Alumno</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Nombres</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pri_apellido" required>
                                        <label class="form-label">Primer Apellido</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="seg_apellido" required>
                                        <label class="form-label">Segundo Apellido</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="Id_acudiente" required>
                                        <label class="form-label">Id Acudiente</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="Id_grado" required>
                                        <label class="form-label">Id Grado</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="Id_grupo" required>
                                        <label class="form-label">Id Grupo</label>
                                    </div>
                                </div>
            
                                <button class="btn btn-primary waves-effect" type="submit" name="btn-signup">REGISTAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->