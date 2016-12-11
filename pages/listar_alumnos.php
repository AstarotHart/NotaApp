<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$alumno = new USER();

$object = new USER();

if(isset($_POST['Detalles']))
{
    $id_alumno = strip_tags($_POST['Detalles']);

    if(($alumno->detalles_alumno($id_alumno)==true)
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
                                            <td><a href="mailto:info@support.com">info@support.com</a></td>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Alumno NO Matriculado","","error");';
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
                                                            <th>Codigo</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Sede</th>
                                                            <th>Grupo</th>
                                                            <th>Detalles</th>
                                                        </tr>
                                                    <thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Sede</th>
                                                            <th>Grupo</th>
                                                            <th>Detalles</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $alumnos = $object->Read_alumno();
                                 
                                if (count($alumnos) > 0) 
                                {
                                    foreach ($alumnos as $alumno) {
                                        $data .= '<tr>
        
                                                <td>' . $alumno['id_alumno'] . '</td>
                                                <td>' . $alumno['nombres'] . '</td>
                                                <td>' . $alumno['primer_apellido'] . '</td>
                                                <td>' . $alumno['segundo_apellido'] . '</td>
                                                <td>' . $alumno['id_sede'] . '</td>
                                                <td>' . $alumno['id_grado'] . '</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-xs waves-effect" data-toggle="modal" data-target="#DetallesAlumno" name="Detalles" value="' . $alumno['id_alumno'] . '">Detalles</button>
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
                        <!-- #LISTAR ALUMNOS -->
                        </div>
                    </div>                

        </div>

    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->