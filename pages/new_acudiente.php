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
            //<!-- Modal Detalles Alumno -->
            echo "<div class='modal fade' id='DetallesAlumno' tabindex='-1' role='dialog'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <div class='panel panel-info'>
                                <div class='panel-heading'>
                                  <h3 class='panel-title'>Sheena Shrestha</h3>
                                </div>
                                <div class='panel-body'>
                                  <div class='row'>
                                    <div class=' col-md-9 col-lg-9 '> 
                                      <table class='table table-user-information'>
                                        <tbody>";

            echo                          "<tr>
                                            <td>Codigo:</td>
                                            <td>Programming</td>
                                          </tr>
                                          <tr>
                                            <td>Nombres:</td>
                                            <td>06/23/2013</td>
                                          </tr>
                                          <tr>
                                            <td>Primer Apellido:</td>
                                            <td>01/24/1988</td>
                                          </tr>
                                            <td>Segundo Apellido</td>
                                            <td>Female</td>
                                          </tr>
                                            <td>Desplazado</td>
                                            <td>Kathmandu,Nepal</td>
                                          </tr>
                                          <tr>
                                            <td>Repitente</td>
                                            <td>            </td>
                                          </tr>
                                            <td>Nombes Acudiente</td>
                                            <td>123-4567-890(Landline)</td>
                                          </tr>
                                          </tr>
                                            <td>Apellidos Acudiente</td>
                                            <td>123-4567-890(Landline)</td>
                                          </tr>
                                          </tr>
                                            <td>Telefono Acudiente</td>
                                            <td>123-4567-890(Landline)</td>
                                          </tr>
                                          </tr>
                                            <td>Fecha Matricula</td>
                                            <td>123-4567-890(Landline)</td>
                                          </tr>
                                         
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>            
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-warning waves-effect' data-dismiss='modal'>Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>";
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