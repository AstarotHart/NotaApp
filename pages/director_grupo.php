<?php 
require_once("class.user.php");

$user                    = new USER();
$object                  = new USER();
$cabecera_director       = new USER();
$cabecera_tabla_director = new USER();
$ini_asignatura          = new USER();
$alumnos_grupo           = new USER();
$notas_def               = new USER();
$Observaciones           = new USER();
$new_observacion         = new USER();
$fechas                  = new USER();
$observaciones_alumnos   = new USER();
$update_observacion      = new USER();


$data_inside        = "";
$data_select        = "";
$footer_table       = "";
$res_obser_alumno   = "";

$list_observaciones = "<ol>";
$res_observaciones  = " ";


//saber si el boton CREAR de logro a sifo inicializado
if (isset($_POST['crear'])) 
{
    $id_grupo_asig =$_POST['id_grupo'];
    $observaciones =$_POST['observacion'];
    
     //Llamada a funcion para crear nuevo LOGRO
     
    if(($new_observacion->register_observaciones($id_grupo_asig,$observaciones))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion Creada!","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion NO Creada.","","error");';
        echo '}, 1000);</script>';
     }
}


//saber si el boton CREAR de logro a sido inicializado
if (isset($_POST['asignar_Observacion'])) 
{
    $id_observacion = $_POST['select_observacion'];
    $id_alumnos     = $_POST['select_alumnos'];
    $id_anio_lec    = $_POST['id_anio_lectivo'];
    $perio_act      = $_POST['id_periodo'];
    $id_grupo       = $_POST['id_grupo'];

    
    $observacion_insert = "";

    foreach ($id_observacion as $id_observacion) 
    {
       $observacion_insert .= $id_observacion.", "; 
    }

    $observacion_insert .=".";

    foreach ($id_alumnos as $id_alumnos)
    {
        
        /*echo "ID OBSER: ".$id_observacion."<br>";
        echo "ID ALUMNO: ".$id_alumnos."<br>";
        echo "ID ANIO: ".$id_anio_lec."<br>";
        echo "ID PERIODO: ".$perio_act."<br>";
        echo "ID GRUPO: ".$id_grupo."<br>";*/
        

        $observaciones_alumnos->register_observaciones_alumno($id_grupo,$id_alumnos,$id_anio_lec,$perio_act,$id_observacion);
    }
    
     
    if($observaciones_alumnos==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion Asignados.","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion NO Asignados.","","error");';
        echo '}, 1000);</script>';
     }
     
}


//saber si el boton ACTUALIZR_OBSERVACION ha sido inicializado
if (isset($_POST['actualizar_Observacion'])) 
{
    $id_observacion_act =$_POST['id_observacion'];
    $observacion        =$_POST['observacion'];
    $id_grupo           =$_POST['id_grupo'];
    $accion             = "Actualizar";
    
     //Llamada a funcion para Actualizar OBSERVACION
     
    if(($update_observacion->update_observacion($id_observacion_act,$id_grupo,$observacion,$accion))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion Actualizada.","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Observacion NO Actualizada.","","error");';
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

    $cabecera_director = $object->cabecera_director($user_id);

    $ids_asignaturas = array();
    $cont_ids_asig = 0;


// Cargar datos en un array con CABECERA
    if (count($cabecera_director) > 0) 
    {
                    
        foreach ($cabecera_director as $cabecera_director) 
        {
            
        }

        $cabecera_tabla_director = $object->cabecera_tabla_director($cabecera_director['id_grupo']);


        $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Nombre Estudiente</th>
                            <th>Codigo</th>';

        if (count($cabecera_tabla_director) > 0) 
        {

            foreach ($cabecera_tabla_director as $cabecera_tabla_director) 
            {
                $ini_asignatura = $object->iniciales_asignaturas($cabecera_tabla_director['nombre_asignatura']);
                $data .='<th>'.$ini_asignatura.'</th>';

                $footer_table .= "<b>".$ini_asignatura."</b>:".$cabecera_tabla_director['nombre_asignatura'].". ";


                $ids_asignaturas[$cont_ids_asig] = $cabecera_tabla_director['id_asignatura'];
                $cont_ids_asig++;
            }
        }

         $data .= '<th>Observaciones</th>';

        $data .= '         </tr>

                        <thead>
                        <tbody>
                        ';

        $id_grupo = $cabecera_director['id_grupo'];
    }

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
                                Director Grupo <small>Lista de Alumnos y su desempeño por asignatura</small>
                            </h2>
                        </div>

                        <div class="body">

                                <?php 

                                $alumnos_grupo = $object->Read_alumnos_grupo($id_grupo);
                                $Observaciones = $object->Read_observaciones($id_grupo);
                                $fechas        = $object->Read_fecha_periodos($cabecera_director['id_anio_lectivo'],$cabecera_director['id_jornada']);


                                // cargar Informacion Periodos
                                if (count($fechas) > 0)
                                { 
                                    $fechas_periodos=array();
                                    $cont_fechas=0;
                                    foreach ($fechas as $fechas)
                                    {
                                        $fechas_periodos[$cont_fechas]=$fechas;
                                        $cont_fechas++;
                                    }

                                    if (count($fechas_periodos) > 0) 
                                    {
                                        
                                        //Name Nota Upload Excel
                                        $name_nota = "";

                                        //# periodos
                                        $no_periodo1 = 1;
                                        $no_periodo2 = 2;
                                        $no_periodo3 = 3;
                                        $no_periodo4 = 4;

                            /* PHP 7 */

                                        //ids Peridos
                                        $id_periodo1 = ((array_column($fechas_periodos, "id_periodo"))[0]);
                                        $id_periodo2 = ((array_column($fechas_periodos, "id_periodo"))[1]);
                                        $id_periodo3 = ((array_column($fechas_periodos, "id_periodo"))[2]);
                                        $id_periodo4 = ((array_column($fechas_periodos, "id_periodo"))[3]);

                                        //Fecha InicioPeridos
                                        $inicio_periodo1 = ((array_column($fechas_periodos, "fecha_inicio_periodo"))[0]);
                                        $inicio_periodo2 = ((array_column($fechas_periodos, "fecha_inicio_periodo"))[1]);
                                        $inicio_periodo3 = ((array_column($fechas_periodos, "fecha_inicio_periodo"))[2]);
                                        $inicio_periodo4 = ((array_column($fechas_periodos, "fecha_inicio_periodo"))[3]);

                                        //Fecha FinPeridos
                                        $fin_periodo1 = ((array_column($fechas_periodos, "fecha_fin_periodo"))[0]);
                                        $fin_periodo2 = ((array_column($fechas_periodos, "fecha_fin_periodo"))[1]);
                                        $fin_periodo3 = ((array_column($fechas_periodos, "fecha_fin_periodo"))[2]);
                                        $fin_periodo4 = ((array_column($fechas_periodos, "fecha_fin_periodo"))[3]);

                                        //Fecha InicioPeridos
                                        $desc_periodo1 = ((array_column($fechas_periodos, "desc_periodo"))[0]);
                                        $desc_periodo2 = ((array_column($fechas_periodos, "desc_periodo"))[1]);
                                        $desc_periodo3 = ((array_column($fechas_periodos, "desc_periodo"))[2]);
                                        $desc_periodo4 = ((array_column($fechas_periodos, "desc_periodo"))[3]);

                            /* PHP 5

                                    //ids Peridos
                                        $id_periodo1 = Array(0 => $fechas_periodos["id_periodo"]);
                                        $id_periodo2 = Array(1 => $fechas_periodos["id_periodo"]);
                                        $id_periodo3 = Array(2 => $fechas_periodos["id_periodo"]);
                                        $id_periodo4 = Array(3 => $fechas_periodos["id_periodo"]);

                                    //Fecha InicioPeridos
                                        $inicio_periodo1 = Array(0 => $fechas_periodos["fecha_inicio_periodo"]);
                                        $inicio_periodo2 = Array(1 => $fechas_periodos["fecha_inicio_periodo"]);
                                        $inicio_periodo3 = Array(2 => $fechas_periodos["fecha_inicio_periodo"]);
                                        $inicio_periodo4 = Array(3 => $fechas_periodos["fecha_inicio_periodo"]);

                                    //Fecha FinPeridos
                                        $fin_periodo1 = Array(0 => $fechas_periodos["fecha_fin_periodo"]);
                                        $fin_periodo2 = Array(1 => $fechas_periodos["fecha_fin_periodo"]);
                                        $fin_periodo3 = Array(2 => $fechas_periodos["fecha_fin_periodo"]);
                                        $fin_periodo4 = Array(3 => $fechas_periodos["fecha_fin_periodo"]);

                                    //Fecha InicioPeridos
                                        $desc_periodo1 = Array(0 => $fechas_periodos["desc_periodo"]);
                                        $desc_periodo2 = Array(1 => $fechas_periodos["desc_periodo"]);
                                        $desc_periodo3 = Array(2 => $fechas_periodos["desc_periodo"]);
                                        $desc_periodo4 = Array(3 => $fechas_periodos["desc_periodo"]);

                            */


                                        date_default_timezone_set('America/Bogota');

                                        // Fecha Actual
                                        $fechaHoy = date('Y-m-d');

                                        $fechaHoy = "2017-01-24";

                                        //comparar fecha primer periodo
                                        if ($fechaHoy > $inicio_periodo1 AND $fechaHoy < $fin_periodo1) 
                                        {
                                            $periodo_Actual = $id_periodo1;
                                        }
                                        elseif ($fechaHoy > $inicio_periodo2 AND $fechaHoy < $fin_periodo2) 
                                        {
                                            $periodo_Actual = $id_periodo2;
                                        }
                                        elseif ($fechaHoy > $inicio_periodo3 AND $fechaHoy < $fin_periodo3) 
                                        {
                                            $periodo_Actual = $id_periodo3;
                                        }
                                        elseif ($fechaHoy > $inicio_periodo4 AND $fechaHoy < $fin_periodo4) 
                                        {
                                            $periodo_Actual = $id_periodo4;
                                        }


                                        
                                    }
                                }

                                 ?>

                            <div class="card">
                                <div class="body">

                                    <div class="col-sm-3">
                                        <b>Grupo:</b> <?php echo $cabecera_director['descripcion_grupo'] ?>
                                    </div>

                                    <div class="col-sm-3">
                                        <b>Sede:</b> <?php echo $cabecera_director['id_sede'] ; ?>
                                    </div>

                                    <div class="col-sm-3">
                                        <b>Periodo:</b> <?php echo $periodo_Actual ; ?>
                                    </div>

                                    <div class="col-sm-3">
                                        <b>Año Lectivo:</b> <?php echo $cabecera_director['id_anio_lectivo'] ; ?>
                                    </div>
                                </div>
                            </div>

                                <?php
                                
                                                                //echo $data;

                                $num = 1;

                                
                                if (count($alumnos_grupo) > 0)
                                {
                        
                                    foreach ($alumnos_grupo as $alumnos_grupo)
                                    {
                                        $data_inside .= '<tr>
                                                            <td>' . $num. '</td>
                                                            <td>' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</td>
                                                            <td>' . $alumnos_grupo['id_alumno'] . '</td>';

                                        $Observaciones_alumnos = $object->Read_observaciones_alumno($id_grupo,$alumnos_grupo['id_alumno'],$cabecera_director['id_anio_lectivo']);
                                        
                                        for($i=0; $i < count($ids_asignaturas); $i++)
                                        {
                                            $notas_def = $object->Read_notas_def_asignatura($ids_asignaturas[$i],$alumnos_grupo['id_alumno'],$cabecera_director['id_anio_lectivo']);

                                            if (count($notas_def) > 0)
                                            {
                                                foreach ($notas_def as $notas_def)
                                                {
                                                    $data_inside .= '<td>' . $notas_def['nota_definitiva_asig'] . '</td>';
                                                }
                                            }
                                            else
                                            {
                                                $data_inside .= '<td>0</td>';
                                            }
                                        }

                                        if (count($Observaciones_alumnos) > 0)
                                        {
                                            foreach ($Observaciones_alumnos as $Observaciones_alumnos)
                                            {   
                                                if ($Observaciones_alumnos['id_estado']==1)
                                                {
                                                    $res_observaciones = $Observaciones_alumnos['id_observacion']. '. ';
                                                }
                                                
                                            }
                                        }
                                        else
                                        {
                                            $res_observaciones = "No hay Observaciones.";
                                        }
                                        
                                        $data_inside .= '<td>
                                                                '.$res_observaciones.'                             
                                                            </td>';

                                        $data_inside .= '</tr>';
                                        $num++;

                                        $data_select .= '<option value="' . $alumnos_grupo['id_alumno'] . '">' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</option>';
                                    
                                    }
                                }
                                else 
                                {
                                    // records not found
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }

                                

                                // Saber si logros ha sido inicializado
                                if (count($Observaciones) > 0)
                                {
                                    $i=1;
                                    foreach ($Observaciones as $Observaciones)
                                    {
                                        $list_observaciones .='<li>' . '<b class="font-10">[' .$Observaciones['id_observacion']. ']</b> ' . $Observaciones['descripcion']  .'
                                                        
                                                        <div class="btn-group dropdown">
                                                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">more_horiz</i>
                                                            <ul class="dropdown-menu pull-left">
                                                                <li><a class="open-EditRow" data-toggle="modal" data-target="#Update-Observacion" data-id="'.$Observaciones['id_observacion'].'" data-desc="'.$Observaciones['descripcion'].'" data-asig="'.$id_grupo.'"><i class="material-icons">mode_edit</i>Editar</a></li>
                                                                <li>
                                                                    <a id="del_observacion" data-id="'.$Observaciones['id_observacion'].'" href="javascript:void(0)"><i class="material-icons">delete</i>Eliminar</a>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                        </li>';

                                        $res_observaciones .='<option value="' .$Observaciones['id_observacion']. '">' .$Observaciones['id_observacion']. '</option>';

                                        $i++;
                                    }

                                    // Saber si res_logros ha sido inicializado
                                    if (isset($List_logros)) 
                                    {
                                        $list_observaciones .= "</ol>";
                                    }
                                    
                                }
                                else
                                {
                                    $list_observaciones = "No hay Observaciones para Mostrar.";
                                }                              
                            ?>
                            
                            <!-- Card Observacioneses-->
                            <div class="card">
                                <div class="body" style="padding-top: 10px;">
                                
                                <!-- Boton para cargar collpse de LOGOS ---->
                                    <div class='col-sm-12'>
                                        <button class="btn bg-cyan waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Observacioneses</button>

                                        <button type='button' class='btn bg-teal waves-effect' data-toggle='modal' data-target='#NewObservacion'>Nueva Observacion</button>
                                    </div>

                                    <!--Boton crear Nuevo Observaciones---->
                                    

                                    <div class="collapse" id="collapseExample">
                                        <!-- Mostrar Logros en un Quote---->
                                        <h5>Observacioneses</h5>
                                        <blockquote class="font-12">
                                            <?php
                                                if (isset($list_observaciones)) 
                                                {
                                                    echo $list_observaciones;
                                                } 
                                            ?>
                                        </blockquote>

                                        <!-- SlectBox Observaciones ---->
                                        <form id="check_logros" method="POST">

                                        <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo ---->
                                            <input type="hidden" class="form-control" name="id_grupo" value="<?php echo $id_grupo; ?>">
                                            <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera_director['id_anio_lectivo']; ?>">
                                            <input type="hidden" class="form-control" name="id_periodo" value="<?php echo $periodo_Actual; ?>">

                                            <div class="demo-checkbox">
                                                <select name="select_observacion[]" size="3" multiple="multiple" tabindex="1">
                                            <?php
                                                
                                                if (isset($res_observaciones))
                                                {
                                                    echo $res_observaciones;
                                                } 
                                            ?>
                                                </select>
                                            </div>

                                            <br>

                                        <!-- Multi Select Alumnos para Observaciones---->
                                            
                                            <select id="optgroup" name="select_alumnos[]" class="searchable" multiple="multiple">
                                            <?php
                                                echo $data_select;
                                             ?>
                                            </select>
                                            

                                            <!-- <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                                                <button type="button" class="btn bg-blue waves-effect" id="select-all">Todos</button>
                                                <button type="button" class="btn bg-red waves-effect" id="deselect-all">Ninguno</button>
                                            </div> -->
                                            
                                            <div class='col-sm-12 align-right'>
                                                <button class="btn bg-green waves-effect" type="submit" name="asignar_Observacion">Aceptar</button>
                                            </div>

                                        </form>                            
                                    </div>

                                </div>
                            </div>
                            

                            <!-- Card TABLA ALUMNOS-->
                            <div class="card" >
                                <div class="body" >

                                    <div id="miTabla">
                                        <?php 
                                            echo $data;
                                            echo $data_inside; 
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                            
                                    <blockquote class="blockquote-reverse m-b-25 font-12">
                                        <?php echo  $footer_table; ?>
                                    </blockquote>
                                    
                                </div>
                            </div>

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

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Jquery Form -->
<script src="../plugins/jquery.form.min.js"></script>

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
</script>

<script type="text/javascript">
    $(function(){
        //enable / disable
       $('#enable').click(function() {
           $('#miTabla #periodo1').editable('toggleDisabled');
       });
    });

    $("[data-toggle=popover]").popover({
    html: true, 
    content: function() {
          return $('#popover-content').html();
        }
});
</script>


<!-- test datos to modal-->
<script type="text/javascript">
    $('.open-EditRow').click(function(){
       var id_observacion = $(this).attr('data-id');
       var desc = $(this).attr('data-desc');
       var id_grupo = $(this).attr('data-asig');
       $('#Area_new #id_observacion').val(id_observacion);
       $('#Area_new #id_grupo').val(id_grupo);
       $('#Area_new #desc_observacion').val(desc);
    });
</script>

<!-- Borrar LOGRO con sweetalert corfirm-->


<script>
    $(document).ready(function(){
        
        readProducts(); /* it will load products when document loads */
        
        $(document).on('click', '#del_observacion', function(e){
            
            var id_observacion = $(this).data('id');
            SwalDelete(id_observacion);
            e.preventDefault();
        });
        
    });
    
    function SwalDelete(id_observacion){
        
        swal({
            title: 'Estas Seguro?',
            text: "La Observacion sera Borrada!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar!',
            showLoaderOnConfirm: true,
              
            preConfirm: function() {
              return new Promise(function(resolve) {
                   
                 $.ajax({
                    url: 'delete_observacion.php',
                    type: 'POST',
                    data: 'id_observacion='+id_observacion,
                    dataType: 'json'
                 })
                 .done(function(response){
                    swal('Borrado!', response.message, response.status);
                    readProducts();
                    location.reload();
                 })
                 .fail(function(){
                    swal('Oops...', 'Algo va mal con ajax !', 'error');
                    location.reload();
                 });
              });
            },
            allowOutsideClick: false              
        }); 
        
    }
    
    function readProducts(){
        $('#load-products').load('read.php');   
    }
    
</script>


<!-- Modal crear nuevo LOGRO -->
    <div class="modal fade" id="NewObservacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nueva Observacion</h4>
                </div>
                <div class="modal-body">
                    <form id="Observacion_new" method="POST">

                        <input type="hidden" class="form-control" name="id_grupo" value="<?php echo $id_grupo; ?>">
          
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <textarea name="observacion" cols="20" rows="4" class="form-control no-resize" maxlength="250" placeholder="Max-255 caracteres" required></textarea>
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

<!-- Modal ACTUALIZAR  LOGRO -->
    <div class="modal fade" id="Update-Observacion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Logro</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">

                        <input type="hidden" class="form-control" name="id_observacion" id="id_observacion">
                        <input type="hidden" class="form-control" name="id_grupo" id="id_grupo">
          
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <textarea id="desc_observacion" name="observacion" cols="30" rows="6" class="form-control no-resize" maxlength="150" required autofocus></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="actualizar_Observacion">Actualizar</button>
                            <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>