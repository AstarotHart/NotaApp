<?php 
require_once("class.user.php");

$anios_sede     =   new USER();
$object         =   new USER();
$grupos         =   new USER();
$nombre_sede    =   new USER();
$asignar_alumno =   new USER();



$show_table_alumnos = "none";


//saber si el boton CREAR de logro a sido inicializado
if (isset($_POST['asignar_alumno'])) 
{
    $id_alumno   =$_POST['select_alumnos'];
    $id_sede_new = $_POST['id_sede_new'];
    $id_anio_lec = $_POST['id_anio_lectivo'];

    echo "Id_alunos: ".$id_alumno."<br>";
    echo "id_sede new: ".$id_sede_new ."<br>";
    echo "anio lectivo: ".$id_anio_lec."<br>";

    if (isset($_POST['select_alumnos']) AND isset($_POST['id_sede_new']) AND isset($_POST['id_anio_lectivo']))
    {
        foreach ($id_alumno as $id_alumno)
        {
            $asignar_alumno->cambio_alumno_sede($id_alumno,$id_sede_new,$id_anio_lec);
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
    elseif (!isset($_POST['select_alumnos'])) 
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Seleccione Almenos un Alumno.","","error");';
        echo '}, 1000);</script>';
    }
    elseif (!isset($_POST['id_sede_new']))
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Seleccione Nueva Sede.","","error");';
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
        $_SESSION['id_sede_asig_alum_sede']=$_POST['id_sede'];
    }

    //saber si el boton CAMBIAR SEDE Y GRUPO a sido inicializado
    if (isset($_POST['btn-select-destroy'])) 
    {
        $_SESSION['id_sede_asig_alum_sede'] = null;
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_sede_asig_alum_sede']))
    {
        $id_sede = $_SESSION['id_sede_asig_alum_sede'];

        $anios_sede = $object->anio_actual($id_sede);

        foreach ($anios_sede as $anios_sede)
        {
            $id_anio_lestivo_sede = $anios_sede['id_anio_lectivo'];
        }
    }

    //Saber si si la variable ID_SEDE E ID_GRUPO
    if (isset($id_sede))
    {        
        $num = 1;

        $data_select = "";
            
        $alumnos_sede = $object->Read_alumnos_sede($id_sede);

        $res_grupos  = " ";

        // Saber si alumnos_sede esta vacio
        if (count($alumnos_sede) > 0) 
        {   
            $show_table_alumnos = "show";

            foreach ($alumnos_sede as $alumnos_sede) 
            {
                $data_select .= '<option value="' . $alumnos_sede['id_alumno'] . '">' . $alumnos_sede['primer_apellido'] . ' ' .$alumnos_sede['segundo_apellido'] . ' ' .$alumnos_sede['nombres'] .'</option>';                
            }
        }

    }

if (isset($id_sede))
{
    $sedes = $object->Read_sedes();
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
                            Asignar Alumnos a Sede <small>Lista de Estudientes Por Sede</small>
                        </h2>
                        
                        <?php 
                        if (isset($id_sede))
                        { 
                            echo "<h4>".$nombre_sede['descripcion_sede']."</h4>";
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
                                                <select class="form-control show-tick" name="id_sede" id="getSede" size="3">
                                                        <option value="">-- Seleccione Sede --</option>
                                                        <?php 
                                                            $user = $object->combobox_sede_alumno_sede();
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

                    </div>
                    

                    <div class="body" style="display: <?php echo $show_table_alumnos; ?>;">
                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card">
                        <div class="body" style="padding-top: 10px;">
                        
                                <!-- Mostrar Logros en un Quote-->
                                <h5>Alumnos</h5>

                                <!-- SlectBox Logros -->
                                <form id="check_logros" method="POST">

                                <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo -->
                                    <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $id_anio_lestivo_sede; ?>">

                                    <select class="form-control show-tick" name="id_sede_new" id="getSede" size="3" tabindex="1">
                                        <option value="">-- Seleccione Sede --</option>
                                        <?php 
                                        if (count($sedes) > 0) 
                                        {                 
                                            foreach ($sedes as $sedes)
                                            {
                                                ?>
                                                <option value="<?php echo $sedes['id_sede']; ?>"><?php echo $sedes['descripcion_sede']; ?></option>'; 
                                                <?php
                                            }
                                        } else {
                                            ?>
                                                <option value=""><p class="col-pink">Sin Sedes</p></option>';
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