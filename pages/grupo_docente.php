<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");

$user = new USER();
$cabecera = new USER();
$nota = new USER();
$falta = new USER();
$object = new USER();

$show_table= "none";

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
                                    <th>P. 1</th>
                                    <th>F. P1</th>
                                    <th>P. 2</th>
                                    <th>F. P2</th>
                                    <th>P. 3</th>
                                    <th>F. P3</th>
                                    <th>P. 4</th>
                                    <th>F. P4</th>
                                    <th>NOTA FINAL</th>
                                    <th>FALTAS TOTALES</th>
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
                $show_table= "show";
            }
        } 

        //echo "contador ".count($users).".";

        if (count($users) > 0) 
        {
                        
            foreach ($users as $users) 
            {
                $notas  = $object->Read_notas($cabecera['id_asignatura'],$users['id_alumno']);
                $faltas = $object->Read_faltas($cabecera['id_asignatura'],$users['id_alumno']);

                    $res_nota1       = "0";
                    $res_nota2       = "0";
                    $res_nota3       = "0";
                    $res_nota4       = "0";
                    $nota_final      = "0";
                    $res_nota_final  = "0";
                    
                    $res_falta1      = "0";
                    $res_falta2      = "0";
                    $res_falta3      = "0";
                    $res_falta4      = "0";
                    $falta_final     = "0";
                    $res_falta_final = "0";


                if (count($notas) > 0) 
                {
                    foreach ($notas as $notas) 
                    {
                        $res_nota1  = $notas['nota1'];
                        $res_nota2  = $notas['nota2'];
                        $res_nota3  = $notas['nota3'];
                        $res_nota4  = $notas['nota4'];
                        $nota_final = ($res_nota1+$res_nota2+$res_nota3+$res_nota4)/4;   
                    }

                    if ($nota_final < "3") 
                    {
                        $res_nota_final = '<p class="font-bold col-pink">'.$nota_final.'</p>';
                    }
                    else
                    {
                        $res_nota_final = $nota_final;
                    }
                    
                }

                if (count($faltas) > 0) 
                {
                    foreach ($faltas as $faltas) 
                    {
                        $res_falta1  = $faltas['inasistencia_p1'];
                        $res_falta2  = $faltas['inasistencia_p2'];
                        $res_falta3  = $faltas['inasistencia_p3'];
                        $res_falta4  = $faltas['inasistencia_p4'];
                        $falta_final = ($res_falta1+$res_falta2+$res_falta3+$res_falta4);    
                    }

                    if ($falta_final >= "4") 
                    {
                        $res_falta_final = '<p class="font-bold col-pink">'.$falta_final.'</p>';
                    }
                    else
                    {
                        $res_falta_final = $falta_final;
                    }
                    
                }



                $data .= '
                        <tr>
                            <td>' . $num. '</td>
                            <td>' . $users['primer_apellido'] . ' ' .$users['segundo_apellido'] . ' ' .$users['nombres'] .'</td>
                            <td>' . $users['id_alumno'] . '</td>
                            <td><span class="xedit" id="'.$users['id_alumno'].'" name="nota1" materia="'.$cabecera['id_asignatura'].'">'.$res_nota1.'</span></td>
                            <td>' . $res_falta1 . '</td>
                            <td>' . $res_nota2  . '</td>
                            <td>' . $res_falta2 . '</td>
                            <td>' . $res_nota3  . '</td>
                            <td>' . $res_falta3 . '</td>
                            <td>' . $res_nota4  . '</td>
                            <td>' . $res_falta4 . '</td>
                            <td>' . $res_nota_final . '</td>
                            <td>' . $res_falta_final . '</td>
                            <td>
                                
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $users['id_alumno'] . '"><i class="material-icons">mode_edit</i></button>
                                </div>
                                    
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
                                Asignaturas <small>Lista de Estudientes Por Asignaturas</small>
                            </h2>
                        </div>
                        <div class="body">
                            
                            <!-- Div mostrar u ocultar tablas -->
                            <div  style="display: <?php echo $show_table; ?>;">
                                <div class="col-sm-3">
                                    <b>Grupo:</b> <?php echo $cabecera['descripcion_grupo'] ; ?>
                                </div>

                                <div class="col-sm-3">
                                    <b>Asignatura:</b> <?php echo $cabecera['nombre_asignatura']; ?>
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

                                <blockquote class="m-b-25 font-12">
                                    <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
                                </blockquote>

                            </div><!-- Fin DIV ocultar o mostrar tabla -->
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
    
    <script src="../js/bootstrap-editable.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {  
                $.fn.editable.defaults.mode = 'popup';
                $('.xedit').editable();     
                $(document).on('click','.editable-submit',function(){
                    var v = $(this).closest('td').children('span').attr('materia');
                    var w = $(this).closest('td').children('span').attr('name');
                    var x = $(this).closest('td').children('span').attr('id');
                    var y = $('.materia').val();
                    var z = $(this).closest('td').children('span');
                    $.ajax({
                        url: "update_nota.php?id="+x+"&data="+y+"&nota="+w+"&materia="+v,
                        type: 'GET',
                        success: function(s){
                            if(s == 'status'){
                            $(z).html(y);}
                            if(s == 'error') {
                            alert('Error Processing your Request!');}
                        },
                        error: function(e){
                            alert('Error Processing your Request!!');
                        }
                    });
                });
        });
    </script>