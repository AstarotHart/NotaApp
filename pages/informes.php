<?php 
require_once("class.user.php");
$grupo = new USER();
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Informes <small>Lista de Informes</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="material-icons">loop</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="doby">
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->