<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");

$user     = new USER();
$cabecera = new USER();
$nota     = new USER();
$falta    = new USER();
$logros   = new USER();
$newLogro = new USER();
$object   = new USER();

$show_table= "none";

if (isset($_POST['crear'])) 
{
    $id_asignatura=$_POST['id_asignatura'];
    $logro=$_POST['logro'];

    /**
     * Llamada a funcion para actualizar los datos del docente
     */
    if(($newLogro->register_logros($id_asignatura,$logro))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro Creado.","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';

     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro NO Creado.","","error");';
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


    // Cargar datos en un array con CABECERA
    if (count($cabecera) > 0) 
    {
                    
        foreach ($cabecera as $cabecera) 
        {
            $show_table= "show";
        }
    } 

    //llamando a la funcion read logros para cargar los losgros por asignatura
    $logros = $object->read_logros($cabecera['id_asignatura']);
    $res_logros = "";

    if (count($logros) > 0)
    {
        foreach ($logros as $logros)
        {
            $res_logros .='<li>' . '<b class="font-10">[' .$logros['id_logro']. ']</b> ' . $logros['descripcion']  .'</li>';
        }
    }
    else
    {
        $res_logros = "No hay logros para Mostrar.!!";
    }

    if (count($users) > 0) 
    {
                    
        foreach ($users as $users) 
        {
            $notas  = $object->Read_notas($cabecera['id_asignatura'],$users['id_alumno']);
            $faltas = $object->Read_faltas($cabecera['id_asignatura'],$users['id_alumno']);

                $res_nota1      = "0";
                $res_nota2      = "0";
                $res_nota3      = "0";
                $res_nota4      = "0";
                $nota_final     = 0;
                $res_nota_final = "0";
                
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

                    $nota_final =  number_format($nota_final,1);  
                }

                if ($nota_final <= 2.9) 
                {
                    $res_nota_final = '<p class="font-bold col-pink">'.$nota_final.'</p>';
                }
                else
                {
                    $res_nota_final = '<b>'.$nota_final.'</b>';
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

            //llamando a la funcion read logros para cargar los losgros por asignatura
            $logros_alumnos = $object->Read_logros_alumno($cabecera['id_asignatura'],$users['id_alumno']);
            $res_logros_alumno = "";


            if (count($logros_alumnos) > 0)
            {
                foreach ($logros_alumnos as $logros_alumnos)
                {
                    $res_logros_alumno =$logros_alumnos['id_logros']. '<br>';
                }
            }
            else
            {
                $res_logros_alumno = "No hay logros para Mostrar.!!";
            }

            $data .= '
                    <tr>
                        <td>' . $num. '</td>
                        <td>' . $users['primer_apellido'] . ' ' .$users['segundo_apellido'] . ' ' .$users['nombres'] .'</td>
                        <td>' . $users['id_alumno'] . '</td>
                        <td><span class="xedit" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="nota1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota1.'</span></td>
                        <td><span tipo="falta" class="xedit" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta1.'</span></td>
                        <td><span class="xedit" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="nota2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota2.'</span></td>
                        <td><span class="xedit" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta2.'</span></td>
                        <td><span class="xedit" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="nota3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota3.'</span></td>
                        <td><span class="xedit" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta3.'</span></td>
                        <td><span class="xedit" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="nota4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota4.'</span></td>
                        <td><span class="xedit" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta4.'</span></td>
                        <td>' . $res_nota_final . '</td>
                        <td>' . $res_falta_final . '</td>
                        <td>
                            
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $users['id_alumno'] . '"><i class="material-icons">mode_edit</i></button>
                            </div>
                            '.$res_logros_alumno.'
                            
                                
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
                            <div class="col-sm-2">
                                <b>Grupo:</b> <?php echo $cabecera['descripcion_grupo'] ; ?>
                            </div>

                            <div class="col-sm-3">
                                <b>Asignatura:</b> <?php echo $cabecera['nombre_asignatura']; ?>
                            </div>

                            <div class="col-sm-2">
                                <b>Periodo:</b> 1
                            </div>

                            <div class="col-sm-2">
                                <b>Año Lectivo:</b> 2017
                            </div>

                            <div class="col-sm-2">
                                <b>Intensidad Horaria:</b> <?php echo $cabecera['intensidad_horaria']; ?>
                            </div>

                            <div id="miTabla">
                                <?php
                                    
                                    echo $data; 
                                     
                                ?>
                            </div>
                                    
                                </tbody>
                            </table>

                            <h5>Logros</h5>
                            <blockquote class="m-b-25 font-12">
                                
                                <ol>
                                    <?php echo $res_logros;?>
                                </ol>
                            <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#NewLogro">Nuevo Logro</button>

                            </blockquote>

                            <blockquote class="blockquote-reverse m-b-25 font-12">
                                <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
                            </blockquote>

                            <button id="enable" class="btn btn-default">enable / disable</button>

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

<!-- Funcion para editar FALTAS alumno-->
<script type="text/javascript">
    jQuery(document).ready(function() {  
            $.fn.editable.defaults.mode = 'popup';
            $('.xedit').editable();     
            $(document).on('click','.editable-submit',function(){
                var u = $(this).closest('td').children('span').attr('anio');
                var v = $(this).closest('td').children('span').attr('materia');
                var w = $(this).closest('td').children('span').attr('name');
                var x = $(this).closest('td').children('span').attr('id_alumno');
                var y = $('.materia').val();
                var z = $(this).closest('td').children('span');

                if (w == "inasistencia_p1" || w == "inasistencia_p2" || w == "inasistencia_p3" || w == "inasistencia_p4" ) 
                {
                    $.ajax({
                        url: "update_falta.php?id="+x+"&data="+y+"&nota="+w+"&materia="+v+"&anio="+u,
                        type: 'GET',
                        success: function(s){
                            location.reload();
                            if(s == 'status'){
                            $(z).html(y);}
                            if(s == 'error') {
                            alert('Error Processing your Request!');}
                        },
                        error: function(e){
                            alert('Error Processing your Request!!');
                        }
                    });
                }
                else
                {
                    $.ajax({
                        url: "update_nota.php?id="+x+"&data="+y+"&nota="+w+"&materia="+v+"&anio="+u,
                        type: 'GET',
                        success: function(s){
                            location.reload();
                            if(s == 'status'){
                            $(z).html(y);}
                            if(s == 'error') {
                            alert('Error Processing your Request!');}
                        },
                        error: function(e){
                            alert('Error Processing your Request!!');
                        }
                    })
                }

                
            });
    });


    $(function(){

        //enable / disable
       $('#enable').click(function() {
           $('#miTabla #periodo1').editable('toggleDisabled');

       });
    });

</script>


<!-- Modal crear nueva ASIGNATURA -->
    <div class="modal fade" id="NewLogro" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nuevo Logro</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">

                        <input type="hidden" class="form-control" name="id_asignatura" value="<?php echo $cabecera['id_asignatura']; ?>">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <textarea name="logro" cols="30" rows="6" class="form-control no-resize" maxlength="150" required autofocus></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="crear">Crear</button>
                            <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>