<?php 
require_once("class.user.php");

$user                    = new USER();
$object                  = new USER();
$cabecera_director       = new USER();
$cabecera_tabla_director = new USER();
$ini_asignatura          = new USER();
<<<<<<< HEAD
$alumnos_grupo          = new USER();
=======
>>>>>>> origin/Laptop

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

    $cabecera_director = $object->cabecera_director($user_id);

//Cargar datos en un array con CABECERA
    if (count($cabecera_director) > 0) 
    {
                    
        foreach ($cabecera_director as $cabecera_director) 
        {
            
        }

<<<<<<< HEAD
        $cabecera_tabla_director = $object->cabecera_tabla_director($cabecera_director['id_grupo']);

        $data = "";
        $data_inside = "";
        $data_select = "";


        $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable display nowrap"" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nombre Estudiente</th>
                                <th>Codigo</th>';

        if (count($cabecera_tabla_director) > 0) 
        {
            $contadorr = 1;
=======
    <!-- Menu -->
    <?php include("../includes/menu.php");

    $cadena = "instituro Estrada";

    $cabecera_director = $object->cabecera_director($user_id);

    $ini_asignatura = $object->iniciales_asignaturas($cadena);

// Cargar datos en un array con CABECERA
    if (count($cabecera_director) > 0) 
    {
                    
        foreach ($cabecera_director as $cabecera_director) 
        {
            
        }

        $cabecera_tabla_director = $object->cabecera_tabla_director($cabecera_director['id_grupo']);

        $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>';

        if (count($cabecera_tabla_director) > 0) 
        {
>>>>>>> origin/Laptop
            foreach ($cabecera_tabla_director as $cabecera_tabla_director) 
            {
                $ini_asignatura = $object->iniciales_asignaturas($cabecera_tabla_director['nombre_asignatura']);
                $data .='<th>'.$ini_asignatura.'</th>';
            }
        }

<<<<<<< HEAD
        $data .= '          </tr>
=======
        $data .= '         </tr>
>>>>>>> origin/Laptop
                        <thead>
                        <tbody>
                        ';
    }
<<<<<<< HEAD
?>
=======

    


    ?>
>>>>>>> origin/Laptop
    <!-- end menu-->


    <section class="content">
        <div class="container-fluid">

            <!-- Lista de Docentes -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Director Grupo <small>Lista de docente y su desempeño por asignatura</small>
                            </h2>
                        </div>

                        <div class="body">

<<<<<<< HEAD
                            <div class="card">
                                <div class="body">

                                    <div class="col-sm-3">
                                        <b>Grupo:</b> <?php echo $cabecera_director['descripcion_grado']."-".$cabecera_director['descripcion_grupo'] ?>
                                    </div>
=======
                            <div class="col-sm-3">
                                <b>Grupo:</b> <?php echo $cabecera_director['descripcion_grado']."-".$cabecera_director['descripcion_grupo'] ?>
                            </div>

                            <div class="col-sm-3">
                                <b>Sede:</b> <?php echo $ini_asignatura ; ?>
                            </div>
>>>>>>> origin/Laptop

                                    <div class="col-sm-3">
                                        <b>Sede:</b> <?php echo $cabecera_director['id_sede'] ; ?>
                                    </div>

                                    <div class="col-sm-3">
                                        <b>Periodo:</b> 1
                                    </div>

                                    <div class="col-sm-3">
                                        <b>Año Lectivo:</b> <?php echo $cabecera_director['id_anio_lectivo'] ; ?>
                                    </div>
                                </div>
                            </div>

                                <?php
                                
                                 
<<<<<<< HEAD
                                $alumnos_grupo = $object->Read_alumnos_dir_grupo($cabecera_director['id_grupo']);
=======
                                 echo $data;
                                 
                                $users = $object->Read_alumnos_dir_grupo($cabecera_director['id_grupo']);
>>>>>>> origin/Laptop
                                $num = 1;

                                
                                if (count($alumnos_grupo) > 0)
                                {
                        
                                    foreach ($alumnos_grupo as $alumnos_grupo)
                                    {
                                        $data_inside .= '<tr>
                                                            <td>' . $num. '</td>
                                                            <td>' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</td>
                                                            <td>' . $alumnos_grupo['id_alumno'] . '</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                         </tr>';
                                        $num++;

                                        $data_select .= '<option value="' . $alumnos_grupo['id_alumno'] . '">' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</option>';
                                    
                                    }
                                } 
                                else 
                                {
                                    // records not found
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }                              
                            ?>
                            
                            <!-- Card Observaciones-->
                            <div class="card">
                                <div class="body" style="padding-top: 10px;">
                                
                                <!-- Boton para cargar collpse de LOGOS ---->
                                    <div class='col-sm-12'>
                                        <button class="btn bg-cyan waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Observaciones</button>

                                        <button type='button' class='btn bg-teal waves-effect' data-toggle='modal' data-target='#NewLogro'>Nuevo Observacion</button>
                                    </div>

                                    <!--Boton crear Nuevo Observacion---->
                                    

                                    <div class="collapse" id="collapseExample">
                                        <!-- Mostrar Logros en un Quote---->
                                        <h5>Observaciones</h5>
                                        <blockquote class="font-12">
                                            <?php
                                                
                                                if (isset($list_Observacion)) 
                                                {
                                                    echo $list_Observacion;
                                                }
                                                else
                                                {
                                                    echo "No hay Observaciones para mostrar.";
                                                }
                                            ?>
                                        </blockquote>

                                        <!-- SlectBox Observacion ---->
                                        <form id="check_logros" method="POST">

                                        <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo ---->
                                            <input type="hidden" class="form-control" name="id_asignatura" value="<?php echo $id_asignatura; ?>">
                                            <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera['id_anio_lectivo']; ?>">

                                            <div class="demo-checkbox">
                                                <select name="select_logros[]" size="3" multiple="multiple" tabindex="1">
                                            <?php
                                                
                                                if (isset($res_Observacion))
                                                {
                                                    echo $res_Observacion;
                                                } 
                                            ?>
                                                </select>
                                            </div>

                                            <br>

                                        <!-- Multi Select Alumnos para Observacion---->
                                            
                                            <select id="optgroup" name="select_alumnos[]" class="ms" multiple="multiple">
                                            <?php
                                                echo $data_select;
                                             ?>
                                            </select>

                                            <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                                                <button type="button" class="btn bg-blue waves-effect" id="select-all">Todos</button>
                                                <button type="button" class="btn bg-red waves-effect" id="deselect-all">Ninguno</button>
                                            </div>
                                            
                                            <div class='col-sm-12 align-right'>
                                                <button class="btn bg-green waves-effect" type="submit" name="asignar_logros">Aceptar</button>
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
                                        <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
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
       var id_logro = $(this).attr('data-id');
       var desc = $(this).attr('data-desc');
       var asig = $(this).attr('data-asig');
       $('#Area_new #id_logro').val(id_logro);
       $('#Area_new #id_asignatura').val(asig);
       $('#Area_new #desc_logro').val(desc);
    });
</script>

<!-- Borrar LOGRO con sweetalert corfirm-->


<script>
    $(document).ready(function(){
        
        readProducts(); /* it will load products when document loads */
        
        $(document).on('click', '#del_logro', function(e){
            
            var id_logro = $(this).data('id');
            SwalDelete(id_logro);
            e.preventDefault();
        });
        
    });
    
    function SwalDelete(id_logro){
        
        swal({
            title: 'Estas Seguro?',
            text: "El Logro sera borrado permanentemente!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar!',
            showLoaderOnConfirm: true,
              
            preConfirm: function() {
              return new Promise(function(resolve) {
                   
                 $.ajax({
                    url: 'delete_logro.php',
                    type: 'POST',
                    data: 'id_logro='+id_logro,
                    dataType: 'json'
                 })
                 .done(function(response){
                    swal('Borrado!', response.message, response.status);
                    readProducts();
                    location.reload();
                 })
                 .fail(function(){
                    swal('Oops...', 'Something went wrong with ajax !', 'error');
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