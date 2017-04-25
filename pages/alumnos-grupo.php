<?php 
require_once("class.user.php");

$anios          =   new USER();
$object         =   new USER();
$grupos         =   new USER();
$nombre_sede    =   new USER();

$show_table_alumnos = "none";
$show_table_logros  = "none";
$res_logros_alumno  = " ";


if (isset($_POST['crear'])) 
{
    $id_anio_lectivo           = strip_tags($_POST['codigo_anio_lectivo']);
    $descripcion_anio_lectivo  = strip_tags($_POST['descripcion_anio_lectivo']);
    $fecha_inicio_anio_lectivo = strip_tags($_POST['fecha_inicio_anio_lectivo']);
    $fecha_fin_anio_lectivo    = strip_tags($_POST['fecha_fin_anio_lectivo']);
    $fecha_inicio_primer       = strip_tags($_POST['fecha_inicio_primer']);
    $fecha_fin_primer          = strip_tags($_POST['fecha_fin_primer']); 
    $fecha_inicio_segundo      = strip_tags($_POST['fecha_inicio_segundo']);
    $fecha_fin_segundo         = strip_tags($_POST['fecha_fin_segundo']);
    $fecha_inicio_tercer       = strip_tags($_POST['fecha_inicio_tercer']);
    $fecha_fin_tercer          = strip_tags($_POST['fecha_fin_tercer']);
    $fecha_inicio_cuarto       = strip_tags($_POST['fecha_inicio_cuarto']);
    $fecha_fin_cuarto          = strip_tags($_POST['fecha_fin_cuarto']);
    $id_sede                   = strip_tags($_POST['id_sede']);

    if(($anios->register_anio_periodos($id_anio_lectivo, $descripcion_anio_lectivo, $fecha_inicio_anio_lectivo, $fecha_fin_anio_lectivo, $fecha_inicio_primer, $fecha_fin_primer, $fecha_inicio_segundo, $fecha_fin_segundo, $fecha_inicio_tercer, $fecha_fin_tercer, $fecha_inicio_cuarto, $fecha_fin_cuarto, $id_sede))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Año Lectivo y periodos creados con exito","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';

        $show_table_alumnos= "show";
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Ni Año lectivo ni Periodos creados","","error");';
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
<?php 
    include("../includes/menu.php");

    //saber si el boton ACEPTAR de seleccionde SEDE a sido inicializado
    if (isset($_POST['btn-select-SE'])) 
    {
        $_SESSION['id_sede']=$_POST['id_sede'];
    }

    //saber si el boton ACEPTAR de seleccionde GRUPO a sido inicializado
    if (isset($_POST['btn-select-GR'])) 
    {
        $_SESSION['id_grupo']=$_POST['id_grupo'];
    }

    if (isset($_SESSION['id_sede']))
    {
        $id_sede = $_SESSION['id_sede'];
    }

    if (isset($_SESSION['id_grupo']))
    {
        $id_grupo = $_SESSION['id_grupo'];
    }

    if (isset($id_sede) AND isset($id_grupo))
    {
        $cabecera = $object->Read_cabecera_asig_grupo($id_grupo,$id_sede);
        
        $num = 1;

        $data_select = "";
        // Design initial table header
        $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable display nowrap"" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Nombres</th>
                                <th>Codigo</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
        // Cargar datos en un array con CABECERA
        if (count($cabecera) > 0) 
        {                        
            foreach ($cabecera as $cabecera) 
            {
                $show_table_alumnos= "show";
            }
        }

        //saber si la variable $id_asignatura fue inicializada
        if (isset($id_grupo))
        {
            $alumnos_grupo = $object->Read_alumnos_asig_grupo($user_id,$id_grupo);
            $res_grupos  = " ";        
        }

        //echo "Numero de ALumnos ".count($alumnos_grupo);


        // Sber si alumnos_grupo esta vacio
        if (count($alumnos_grupo) > 0) 
        {      
            foreach ($alumnos_grupo as $alumnos_grupo) 
            {
                $data .= '
                    <tr>
                        <td>' . $num. '</td>
                        <td>' . $alumnos_grupo['primer_apellido'] .'</td>
                        <td>' . $alumnos_grupo['segundo_apellido'] . '</td>
                        <td>' . $alumnos_grupo['nombres'] . '</td>
                        <td>' . $alumnos_grupo['id_alumno'] . '</td>
                    </tr>';
                $num++;

                $data_select .= '<option value="' . $alumnos_grupo['id_alumno'] . '">' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</option>';

                //}
                
            }
        }
        else 
        {
            // records not found
            $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
        }
         
        $data .= '</tbody></table>';
    }

if (isset($id_sede))
{
    $grupos = $object->Read_grupos_sede($id_sede);

    //$sede = $object->Read_nombres_sede($id_sede);
}
    

?>
<!-- end menu-->

<section class="content">
    <div class="container-fluid">

        <!-- Lista de Docentes -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="padding-bottom: 10px;"">
                        <h2>
                            Asignaturas <small>Lista de Estudientes Por Grupo</small>
                        </h2>
                        
                        <?php 
                        if (isset($id_sede))
                        { 
                            echo "<h5>".$id_sede."</h5>";
                        }
                        else
                        {
                            ?>
                            <!-- form para seleccionar GRUPO por ASIGNATURA -->
                            <form style="margin-bottom: 2px;" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group" style="margin-bottom: 2px;">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_sede" id="getSede">
                                                        <option value="">-- Seleccione Sede --</option>
                                                        <?php 
                                                            $user = $object->combobox_sede();
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn bg-teal waves-effect" type="submit" name="btn-select-SE">Aceptar</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } 
                        ?>
                        <?php 
                        if (isset($id_grupo))
                        { 
                            $nombre_sede=$object->Read_grupos_id($id_sede);

                            foreach ($nombre_sede as $nombre_sede) 
                            {
                                
                            }

                            print_r($nombre_sede);

                            echo "<h5>".$nombre_sede['descripcion_sede']."</h5>";

                            $nombre_sede = null;
                        }
                        else
                        {
                            ?> 
                            <!-- form para seleccionar GRUPO por ASIGNATURA -->
                            <form style="margin-bottom: 2px;" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group" style="margin-bottom: 2px;">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_grupo" id="getGrupo">
                                                        <option value="">-- Seleccione Grupo --</option>
                                                        <?php 
                                                        if (count($grupos) > 0) 
                                                        {                 
                                                            foreach ($grupos as $grupo)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $grupo['id_grupo']; ?>"><?php echo $grupo['descripcion_grado']."-".$grupo['descripcion_grupo']; ?></option>'; 
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                                <option value=""><p class="col-pink">Sin Grupos en la Sede</p></option>';
                                                            <?php
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn bg-teal waves-effect" type="submit" name="btn-select-GR">Aceptar</button>
                                    </div>
                                </div>
                            </form>

                        <?php 
                        } 
                        ?>

                    </div>
                    

                    <div class="body" >

                        <div class="card" >
                            <div class="body" >

                                <?php   
                                if (isset($id_grupo))
                                { ?>   
                                <div class="col-sm-4">
                                    <b>Grupo:</b> <?php if (isset($cabecera['descripcion_grupo'])) 
                                    {
                                        echo $cabecera['descripcion_grado']."-".$cabecera['descripcion_grupo'];
                                    }else{echo " ";} ?>
                                </div>

                                <div class="col-sm-4">
                                    <b>Director Grupo:</b> <?php if (isset($cabecera['id_docente'])) 
                                    {
                                         echo $cabecera['id_docente'];
                                    }else{echo " ";} ?>
                                </div>

                                <div class="col-sm-4">
                                    <b>Año Lectivo:</b> <?php if (isset($cabecera['id_anio_lectivo'])) 
                                    {
                                         echo $cabecera['id_anio_lectivo'];
                                    }else{echo " ";} ?>
                                </div>
                                
                            </div>
                        </div>
                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card">
                        <div class="body" style="padding-top: 10px;">
                        
                                <!-- Mostrar Logros en un Quote-->
                                <h5>Logros</h5>
                                <blockquote class="font-12">
                                    <?php
                                        
                                        if (isset($list_logros)) 
                                        {
                                            echo $list_logros;
                                        } 
                                    ?>
                                </blockquote>

                                <!-- SlectBox Logros -->
                                <form id="check_logros" method="POST">

                                <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo --> 
                                    <input type="hidden" class="form-control" name="id_asignatura" value="<?php echo $id_asignatura; ?>">
                                    <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera['id_anio_lectivo']; ?>">

                                    <div class="demo-checkbox">
                                        <select name="select_logros[]" size="3" multiple="multiple" tabindex="1">
                                    <?php
                                        
                                        if (isset($res_logros)) 
                                        {
                                            echo $res_logros;
                                        } 
                                    ?>
                                        </select>
                                    </div>

                                    <br>

                                <!-- Multi Select Alumnos para LOGROS-->
                                    
                                    <select multiple id="optgroup" name="select_alumnos[]" class="searchable" multiple="multiple">
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
                                    <br><br>

                                </form>                            
                          
                    </div>
                </div><!-- Fin div SHOW-->

                </div>
                </div>

            </div>
        </div>
        <!-- #END# Lista Docentes -->
    <?php } ?>
        </div>
    </section>

<?php include("../includes/footer.php");?>
<!-- #Footer -->

<script src="../js/bootstrap-editable.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Jquery Form -->
<script src="../plugins/jquery.form.min.js"></script>