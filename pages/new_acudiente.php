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
    $phone = strip_tags($_POST['phone']);

    try
    {
        $stmt = $user->runQuery("SELECT id_acudiente FROM acudiente WHERE id_acudiente=:id_acudiente");
        $stmt->execute(array(':id_acudiente'=>$cc));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
        if($row['id_acudiente']==$cc) 
        {
            $show_mensaje_err= "show";
        }
        else
        {
            if($user->register_acudiente($cc,$nombres,$prim_apellido,$seg_apellido,$phone))
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
            <!-- end Mensaje Buen-->

            <!-- Mensaje Mal-->
            <div class="alert alert-warning" style="display: <?php echo $show_mensaje_err; ?>;">
                <strong>Bad done!</strong> CC de usuario ya inscrita.
            </div>
            <!-- end Mensaje Mal-->

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                        <div class="header">
                            <h2>
                                Acudientes <small>Lista de acudientes</small>
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
                        <!-- LISTAR ACUDIENTES -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>No. Identificacion</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Telefono</th>
                                                            <th>Actualizar</th>
                                                            <th>Borrar</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $users = $object->Read_acudiente();
                                 
                                if (count($users) > 0) {
                                    $number = 1;
                                    foreach ($users as $user) {
                                        $data .= '<tr>
                                                <td>' . $number . '</td>
                                                <td>' . $user['id_acudiente'] . '</td>
                                                <td>' . $user['nombres'] . '</td>
                                                <td>' . $user['prim_apellido'] . '</td>
                                                <td>' . $user['seg_apellido'] . '</td>
                                                <td>' . $user['telefono'] . '</td>
                                                <td>
                                                    <button onclick="GetUserDetails(' . $user['id_acudiente'] . ')" class="btn btn-warning">Update</button>
                                                </td>
                                                <td>
                                                    <button onclick="DeleteUser(' . $user['id_acudiente'] . ')" class="btn btn-danger">Delete</button>
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
                        <!-- #LISTAR ACUDIENTES -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>NUEVO ACUDIENTE</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="cc" required>
                                        <label class="form-label">CC</label>
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
                                        <input type="phone" class="form-control" name="phone" required>
                                        <label class="form-label">Telefono</label>
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