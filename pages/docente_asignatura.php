<?php 
require_once("class.user.php");

$anios                  =   new USER();
$object_docente_grupo   =   new USER();
$grupos                 =   new USER();
$nombre_sede            =   new USER();
$asignar_docente_asignatura =   new USER();

$show_table_alumnos = "none";
$show_table_logros  = "none";
$show_combox_grupo  =  "show";
$res_logros_alumno  = " ";


//saber si el boton CREAR de logro a sido inicializado
if (isset($_POST['asignar_docente_asignatura'])) 
{
    $id_grupo=$_POST['id_grupo'];
    $id_docente=$_POST['id_docente'];
    $id_asignatura=$_POST['select_alumnos'];
    $id_anio_lectivo= $_POST['id_anio_lectivo'];

    foreach ($id_asignatura as $id_asignatura)
    {
        $asignar_docente_asignatura->asignar_docente_asignatura($id_docente,$id_asignatura,$id_anio_lectivo,$id_grupo);
    }
   
     
    if($asignar_docente_asignatura==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Asignaturas Asignadas.","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Asignaturas NO Asignadas.","","error");';
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
        $_SESSION['id_sede_asig_grupo']=$_POST['id_sede'];
    }

    //saber si el boton ACEPTAR de seleccionde GRUPO a sido inicializado
    if (isset($_POST['btn-select-GR'])) 
    {
        $_SESSION['id_grupo_asig_grupo']=$_POST['id_grupo'];
    }

    //saber si el boton CAMBIAR SEDE Y GRUPO a sido inicializado
    if (isset($_POST['btn-select-destroy'])) 
    {
        $_SESSION['id_sede_asig_grupo'] = null;
        $_SESSION['id_grupo_asig_grupo'] = null;
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_sede_asig_grupo']))
    {
        $id_sede = $_SESSION['id_sede_asig_grupo'];
    }

    //Saber si si la variable de session ID_GRUPO
    if (isset($_SESSION['id_grupo_asig_grupo']))
    {
        $id_grupo = $_SESSION['id_grupo_asig_grupo'];
    }

    //Saber si si la variable ID_SEDE E ID_GRUPO
    if (isset($id_sede))
    {
        $cabecera = $object_docente_grupo->anio_lectivo_activo("1");
        
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

        $asignatura = $object_docente_grupo->Read_asignaturas_sede($id_sede);
        $asignatura_asig = $object_docente_grupo->Read_asignaturas_asig_asignatura($id_sede);
        $grupos = $object_docente_grupo->Read_grupos_sede($id_sede);
        $nombre_sede = $object_docente_grupo->nombre_sede($id_sede);

        foreach ($nombre_sede as $nombre_sede) 
        {
            # code...
        }

        $docentes = $object_docente_grupo->Read_docente_sede($id_sede);
        $res_grupos  = " ";

        //print_r($asignatura_asig); 

        //print_r($asignatura);   


        // Sber si alumnos_grupo esta vacio
        if (count($asignatura) > 0) 
        {  
            $foundflag=false;
            foreach($asignatura_asig as $item)
            {
                 foreach($asignatura as $item1)
                 {
                    if($item['id_asignatura'] == $item1['id_asignatura'])
                    {
                       $foundflag = true;
                       $array[]=$item1['id_asignatura'];
                    }
                }
                if(!$foundflag)
                {
                    $data_select .= '<option value="' . $item['id_asignatura'] . '">' . $item['nombre_asignatura'] .'</option>';
                }
            }
            foreach($asignatura as $item1)
            {
                 if(!(in_array($item1['id_asignatura'],$array)))
                 {
                    $data_select .= '<option value="' . $item1['id_asignatura'] . '">' . $item1['nombre_asignatura'] .'</option>';
                 }
            }
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
                            Asignaturas-Grupos<small>Asignar Asignaturas a grupos.</small>
                        </h2>
                        
                        <?php 
                        if (isset($id_sede))
                        { 
                            echo "<h5>".$nombre_sede['descripcion_sede']."</h5>";
                            echo "<h5>".$cabecera['descripcion_anio_lectivo']."</h5>";
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
                                                            $user = $object_docente_grupo->combobox_sede();
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


                    </div>
                    

                    <div class="body" style="display: <?php echo $show_table_alumnos; ?>;>
                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card">
                        <div class="body" style="padding-top: 10px;">

                                <!-- SlectBox Logros -->
                                <form id="check_logros" method="POST">

                                <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo --> 
                                    <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera['id_anio_lectivo']; ?>">

                                    <select class="form-control show-tick" name="id_docente" id="getGrupo" size="3" tabindex="1">
                                        <option value="">-- Seleccione Docente --</option>
                                        <?php 
                                        if (count($docentes) > 0) 
                                        {                 
                                            foreach ($docentes as $docentes)
                                            {
                                                ?>
                                                <option value="<?php echo $docentes['id_docente']; ?>"><?php echo $docentes['prim_apellido']." ".$docentes['seg_apellido']." ".$docentes['nombres']; ?></option>'; 
                                                <?php
                                            }
                                        } else {
                                            ?>
                                                <option value=""><p class="col-pink">Sin Grupos en la Sede</p></option>';
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <select class="form-control show-tick" name="id_grupo" id="getGrupo" size="3" tabindex="1">
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
                                    
                                    <select multiple id="optgroup" name="select_alumnos[]" class="searchable">
                                        <?php
                                            echo $data_select;
                                         ?>
                                    </select>

                                    <!-- <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                                        <button type="button" class="btn bg-blue waves-effect" id="select-all">Todos</button>
                                        <button type="button" class="btn bg-red waves-effect" id="deselect-all">Ninguno</button>
                                    </div> -->
                                    
                                    <div class='col-sm-12 align-right'>
                                        <button class="btn bg-green waves-effect" type="submit" name="asignar_docente_asignatura">Aceptar</button>
                                    </div>
                                    <br><br>

                                </form>                            
                          
                   
                </div><!-- Fin div SHOW-->

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