<?php 
require_once("class.user.php");
$alumno = new USER();

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

                                                <form id="detalles_alumno" method="POST">
                                                    <button type="submit" class="btn btn-info btn-xs waves-effect" data-toggle="modal" data-target="#DetallesAlumno" name="Detalles" value="' . $alumno['id_alumno'] . '">Detalles</button>
                                                </form>
                                                    

                                                <button data-toggle="modal" data-target="#view-modal" data-id="'.$row['user_id'].'" id="getUser" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i> View</button>

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


                       <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                                <i class="glyphicon glyphicon-user"></i> User Profile
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                           <div id="modal-loader" style="display: none; text-align: center;">
                            <img src="ajax-loader.gif">
                           </div>
                       
                           <div id="dynamic-content">
                                        
                           <div class="row"> 
                                <div class="col-md-12"> 
                                
                                <div class="table-responsive">
                                
                                <table class="table table-striped table-bordered">
                                <tr>
                                <th>First Name</th>
                                <td id="txt_fname"></td>
                                </tr>
                                     
                                <tr>
                                <th>Last Name</th>
                                <td id="txt_lname"></td>
                                </tr>
                                            
                                <tr>
                                <th>Email ID</th>
                                <td id="txt_email"></td>
                                </tr>
                                            
                                <tr>
                                <th>Position</th>
                                <td id="txt_position"></td>
                                </tr>
                                            
                                <tr>
                                <th>Office</th>
                                <td id="txt_office"></td>
                                </tr>
                                            
                                </table>
                                
                                </div>
                                       
                                </div> 
                          </div>
                          
                          </div> 
                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div><!-- /.modal -->             

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->

    <script>
    $(document).ready(function(){
    
        $(document).on('click', '#getUser', function(e){
            
            e.preventDefault();
            
            var uid = $(this).data('id'); // get id of clicked row
            
            $('#dynamic-content').hide(); // hide dive for loader
            $('#modal-loader').show();  // load ajax loader
            
            $.ajax({
                url: 'getuser.php',
                type: 'POST',
                data: 'id='+uid,
                dataType: 'json'
            })
            .done(function(data){
                console.log(data);
                $('#dynamic-content').hide(); // hide dynamic div
                $('#dynamic-content').show(); // show dynamic div
                $('#txt_fname').html(data.id_alumno);
                $('#txt_lname').html(data.nombres);
                $('#txt_email').html(data.primer_apellido);
                $('#txt_position').html(data.segundo_apellido);
                $('#txt_office').html(data.id_sede);
                $('#txt_office').html(data.id_grado);
                $('#txt_office').html(data.fecha_matricula);
                $('#txt_office').html(data.desplazado);
                $('#txt_office').html(data.repitente);
                $('#txt_office').html(data.nombre_acudiente);
                $('#txt_office').html(data.apellidos_acudiente);
                $('#txt_office').html(data.telefono_acudiente);
                $('#modal-loader').hide();    // hide ajax loader
            })
            .fail(function(){
                $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Algo ha salido mal, por favor trata de nuevo...');
            });
            
        });
        
    });

</script>