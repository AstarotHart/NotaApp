<?php 
require_once("class.user.php");
$alumnos = new USER();
$object = new USER();


if(isset($_POST['Detalles']))
{
    $id_alumno = strip_tags($_POST['Detalles']);

    $detalles_alumnos = $object->detalles_alumno($id_alumno);

    if($detalles_alumnos!==false)
    {
        /*
            echo '<div class="panel panel-info" id="DetallesAlumno" tabindex="-1" role="dialog">';
            echo '    <div class="modal-dialog" role="document">';
            echo '        <div class="modal-content">';
            echo '            <div class="modal-body">';
            echo '                <div class="panel panel-info">';
            echo '                    <div class="panel-heading">';
            echo '                      <h3 class="panel-title">Sheena Shrestha</h3>';
            echo '                    </div>';
            echo '                    <div class="panel-body">';
            echo '                      <div class="row">';
            echo '                        <div class="col-md-9 col-lg-9 "> ';
            echo '                          <table class="table table-user-information">';
            echo '                            <tbody>';

            echo '                              <tr>';
            echo '                                <td>Codigo:</td>';
            echo '                                <td>'.$detalles_alumnos["id_alumno"].'</td>';
            echo '                              </tr>';
            echo '                              <tr>';
            echo '                                <td>Nombres:</td>';
            echo '                                <td>'.$detalles_alumnos["nombre"].'</td>';
            echo '                              </tr>';
            echo '                              <tr>';
            echo '                                <td>Primer Apellido:</td>';
            echo '                                <td>'.$detalles_alumnos["primer_apellido"].'</td>';
            echo '                              </tr>';
            echo '                                <td>Segundo Apellido</td>';
            echo '                                <td>'.$detalles_alumnos["segundo_apellido"].'</td>';
            echo '                              </tr>';
            echo '                                <td>Desplazado</td>';
            echo '                                <td>'.$detalles_alumnos["desplazado"].'</td>';
            echo '                              </tr>';
            echo '                              <tr>';
            echo '                                <td>Repitente</td>';
            echo '                                <td>'.$detalles_alumnos["repitente"].'</td>';
            echo '                              </tr>';
            echo '                                <td>Nombes Acudiente</td>';
            echo '                                <td>'.$detalles_alumnos["nombre_acudiente"].'</td>';
            echo '                              </tr>';
            echo '                              </tr>';
            echo '                                <td>Apellidos Acudiente</td>';
            echo '                                <td>'.$detalles_alumnos["apellidos_acudiente"].'</td>';
            echo '                              </tr>';
            echo '                              </tr>';
            echo '                                <td>Telefono Acudiente</td>';
            echo '                                <td>'.$detalles_alumnos["telefono_acudiente"].'</td>';
            echo '                              </tr>';
            echo '                              </tr>';
            echo '                                <td>Fecha Matricula</td>';
            echo '                                <td>'.$detalles_alumnos["fecha_matricula"].'</td>';
            echo '                              </tr>';
            
            echo '                           </tbody>';
            echo '                         </table>';
            echo '                       </div>';
            echo '                     </div>';
            echo '                   </div>            ';
            echo '               </div>';
            echo '           </div>';
            echo '           <div class="modal-footer">';
            echo '               <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Cerrar</button>';
            echo '           </div>';
            echo '       </div>';
            echo '   </div>';
            echo '/div>';
        */
       
        echo "<PRE>";
        print_r($detalles_alumnos);
        echo "</PRE>";
       
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Error al mostrar Detalles de Alumno","","error");';
        echo '}, 1000);</script>';
    }
}
 ?>
<!DOCTYPE html>
<html>


    <!-- Top Bar -->
    <?php include("../includes/header.php");?>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php include("../includes/menu.php");?>
    <!-- end menu-->

    
    <section class="content">
        <div class="container-fluid">
            
            <!-- Metarial Design Buttons -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>
                                Alumnos <small>Lista de Alumnos por intitucion Educativa</small>
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
                                                <td>' . $alumno['descripcion_sede'] . '</td>
                                                <td>' . $alumno['descripcion_grado'] . '-'.$alumno['descripcion_grupo'] . '</td>
                                                <td>

                                                
                                                    <button data-toggle="modal" data-target="#view-modal" data-id="'.$alumno['id_alumno'].'" id="getUser" class="btn btn-primary btn-xs waves-effect"><i class="material-icons">info_outline    </i></button>

                                                    <button data-toggle="modal" data-target="#view-modal" data-id="' . $alumno['id_alumno'] . '" id="getUser" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i> View</button>

                                                
                                                    <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#DetallesAlumno" name="Detalles" onclick="' . $alumno['id_alumno'] . '"><i class="material-icons">mode_edit</i></button>
                                                
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->