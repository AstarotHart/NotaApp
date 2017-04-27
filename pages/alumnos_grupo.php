<?php 
require_once("class.user.php");

$anios          =   new USER();
$object         =   new USER();
$grupos         =   new USER();
$nombre_sede    =   new USER();
$asignar_alumno    =   new USER();

$show_table_alumnos = "none";
$show_table_logros  = "none";
$show_combox_grupo  =  "show";
$res_logros_alumno  = " ";


//saber si el boton CREAR de logro a sido inicializado
if (isset($_POST['asignar_alumno'])) 
{
    $id_grupo_old=$_POST['id_grupo_old'];
    $id_alumno=$_POST['select_alumnos'];
    $id_grupo_new = $_POST['id_grupo_new'];
    $id_anio_lec= $_POST['id_anio_lectivo'];

    foreach ($id_alumno as $id_alumno)
    {

        $asignar_alumno->cambio_alumno_grupo($id_grupo_new,$id_alumno,$id_anio_lec);
    }
   
     
    if($asignar_alumno==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Alumno Asignados.","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Alumno NO Asignados.","","error");';
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

    //saber si el boton CAMBIAR SEDE Y GRUPO a sido inicializado
    if (isset($_POST['btn-select-destroy'])) 
    {
        $_SESSION['id_sede'] = null;
        $_SESSION['id_grupo'] = null;
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_sede']))
    {
        $id_sede = $_SESSION['id_sede'];
    }

    //Saber si si la variable de session ID_GRUPO
    if (isset($_SESSION['id_grupo']))
    {
        $id_grupo = $_SESSION['id_grupo'];
    }

    //Saber si si la variable ID_SEDE E ID_GRUPO
    if (isset($id_sede) and isset($id_grupo))
    {
        $cabecera = $object->Read_cabecera_asig_grupo($id_grupo,$id_sede);
        
        $num = 1;

        $data_select = "";
        
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
            $alumnos_grupo = $object->Read_alumnos_asig_grupo($id_grupo);
            $res_grupos  = " ";      
        }

        // Sber si alumnos_grupo esta vacio
        if (count($alumnos_grupo) > 0) 
        {      
            foreach ($alumnos_grupo as $alumnos_grupo) 
            {
                $data_select .= '<option value="' . $alumnos_grupo['id_alumno'] . '">' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</option>';                
            }
        }
        
    }

if (isset($id_sede))
{
    $grupos = $object->Read_grupos_sede($id_sede);
    $nombre_sede = $object->nombre_sede($id_sede);

    foreach ($nombre_sede as $nombre_sede) 
    {
        # code...
    }
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
                            echo "<h5>".$nombre_sede['descripcion_sede']."</h5>";
                        ?>
                            <div class="align-right">
                                <form id="destroy_variables" method="POST">
                                    <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Sede y Grupo</button>
                                </form>
                            </div>
                        <?php 
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
                            $show_combox_grupo = "none";
                        } 
                        ?>
                        <?php 
                        if (isset($id_grupo) )
                        { 
                            
                        }
                        else
                        {
                            ?> 
                            <div  style="display: <?php echo $show_combox_grupo; ?>;">
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
                            </div>

                        <?php 
                        } 
                        ?>

                    </div>
                    

                    <div class="body" style="display: <?php echo $show_table_alumnos; ?>;>

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
                                <h5>Alumnos</h5>

                                <!-- SlectBox Logros -->
                                <form id="check_logros" method="POST">

                                <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo --> 
                                    <input type="hidden" class="form-control" name="id_grupo_old" value="<?php echo $id_grupo; ?>">
                                    <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera['id_anio_lectivo']; ?>">

                                    <select class="form-control show-tick" name="id_grupo_new" id="getGrupo" size="3" tabindex="1">
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

                                    <br>

                                <!-- Multi Select Alumnos para LOGROS-->
                                    
                                    <select multiple id="optgroup" name="select_alumnos[]" class="searchable" multiple="multiple">
                                        <?php
                                            echo $data_select;
                                         ?>
                                    </select>

                                    <!-- <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                                        <button type="button" class="btn bg-blue waves-effect" id="select-all">Todos</button>
                                        <button type="button" class="btn bg-red waves-effect" id="deselect-all">Ninguno</button>
                                    </div> -->
                                    
                                    <div class='col-sm-12 align-right'>
                                        <button class="btn bg-green waves-effect" type="submit" name="asignar_alumno">Aceptar</button>
                                    </div>
                                    <br><br>

                                </form>                            
                          
                   
                </div><!-- Fin div SHOW-->

                </div>
                </div>

            </div>
        </div>
        <!-- #END# Lista Docentes -->
    <?php } ?>
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