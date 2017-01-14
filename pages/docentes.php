<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$user = new USER();
$object = new USER();

if (isset($_POST['new_pass_docente_admin']))
{
    $id_docente_docente=$_POST['id_docente_docente'];   

    /**
     * Llamada a funcion para cambiar la  contraseniadel docente
     */
    if(($user->new_pass_docente_admin($id_docente_docente))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Contraseña Actualizada","","success");';
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



    <!-- Top Bar -->
    <?php include("../includes/header.php");?>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php include("../includes/menu.php");?>
    <!-- end menu-->

    <section class="content">
        <div class="container-fluid">

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
                                                            <th>Accion</th>
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
                                                <td>' . $user['des_tipo_usuario'] . '</td>
                                                <td>' . $user['descripcion_sede'] . '</td>
                                                <td>
                                                    
                                                    <form id="new_pass_admin" method="POST">
                                                        <input type="hidden" class="form-control" name="id_docente_docente" value="'. $user['id_docente'] .'">
                                                        <input type="hidden" class="form-control" name="new_pass_docente" value="'. $user['id_docente'] .'">
                                                    
                                                        <button class="btn btn-warning waves-effect" type="submit" name="new_pass_docente_admin">Nueva Contraseña</button>
                                                    </form>
                                                        
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

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->

    <script type="text/javascript">
    var accion;
    var idP;
    function new_pass(id, nombres, ocupacion, telefono, sitioweb){
      accion = 'E';
      idP = id;
      document.frmClientes.nombress.value = nombres;
      document.frmClientes.ocupacion.value = ocupacion;
      document.frmClientes.telefono.value = telefono;
      document.frmClientes.sitioweb.value = sitioweb;
      $('#modal').modal('show');
    }

    </script>