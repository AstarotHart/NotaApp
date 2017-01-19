<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$user = new USER();
$cabecera = new USER();
$nota = new USER();
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
    <?php 

        include("../includes/menu.php");

        $users = $object->Read_alumnos_grupo($user_id);
        $cabecera = $object->Read_cabecera_grupo($user_id);
        $num = 1;

        // Design initial table header
        $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nombre Estudiente</th>
                                    <th>Codigo</th>
                                    <th>Nota</th>
                                    <th>Faltas</th>
                                    <th>Acciones</th>
                                    
                                </tr>
                            <thead>

                            <tbody>

                            ';


        // Cargar datos en un arrar con CABECERA
        if (count($cabecera) > 0) 
        {
                        
            foreach ($cabecera as $cabecera) 
            {
                
                
            }
        } 

        echo "contador ".count($users).".";

        if (count($users) > 0) 
        {
                        
            foreach ($users as $users) 
            {
                $nota = $nota->Read_nota($users['id_alumno']);

                $data .= '<tr>
                        <td>' . $num. '</td>
                        <td>' . $users['primer_apellido'] . ' ' .$users['segundo_apellido'] . ' ' .$users['nombres'] .'</td>
                        <td>' . $users['id_alumno'] . '</td>
                        <td>' . $nota->nota . '</td>
                        <td>' . $users['des_tipo_usuario'] . '</td>
                        <td>
                            
                            <form id="new_pass_admin" method="POST">
                                <input type="hidden" class="form-control" name="id_docente_docente" value="'. $users['id_alumno'] .'">
                                <input type="hidden" class="form-control" name="new_pass_docente" value="'. $users['id_alumno'] .'">
                            
                                <button class="btn btn-warning waves-effect" type="submit" name="new_pass_docente_admin">Nueva Contraseña</button>
                            </form>
                                
                        </td>
                    </tr>';

                    $num++;
                
            }
        } 
        else 
        {
            // records not found
            $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
        }
         
        $data .= '<tbody></table>';

    ?>
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

                            <div class="col-sm-3">
                                <b>Grupo:</b> <?php echo $cabecera['descripcion_grado'] . '-'.$cabecera['descripcion_grupo'] ; ?>
                            </div>

                            <div class="col-sm-3">
                                <b>Sede:</b> <?php echo $cabecera['descripcion_sede']; ?>
                            </div>

                            <div class="col-sm-3">
                                <b>Periodo:</b> 1
                            </div>

                            <div class="col-sm-3">
                                <b>Año Lectivo:</b> 2017
                            </div>
                                <?php
                                
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