<?php 
require_once("class.user.php");

$anio_lectivo_sede =   new USER();
$object            =   new USER();
$grupos            =   new USER();
$alumno            =   new USER();
$grados            =   new USER();
$nombre_sede       =   new USER();
$nombre_grupo      =   new USER();
$nombre_alumno     =   new USER();
$asignar_alumno    =   new USER();

$show_opciones_sede     = "none";
$show_table_logros      = "none";
$show_combox_sede       = "none";
$show_combox_grado      = "none";
$show_combox_grupo      = "none";
$show_combox_individual = "none";
$res_logros_alumno      = " ";
$nom_alumno = "";


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

    //saber si el boton CAMBIAR SEDE Y GRUPO a sido inicializado
    if (isset($_POST['btn-select-destroy'])) 
    {
        $_SESSION['opcion']     = null;
        $_SESSION['id_sede']    = null;
        $_SESSION['id_grupo']   = null;
        $_SESSION['id_grado']   = null;
        $_SESSION['id_alumno']  =null;
        $_SESSION['nom_alumno'] =null;
    }

/* ------------- SELECCIONAR OPCION ------------- */

    //saber si el boton ACEPTAR de seleccionde OPCION a sido inicializado
    if (isset($_POST['btn-select-OP'])) 
    {
        $_SESSION['opcion']=$_POST['opcion'];
    }
    

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['opcion']))
    {
        $id_opcion = $_SESSION['opcion'];
    }
/* ----------- FIN SELECCIONAR OPCION ----------- */



/* ------------- SELECCIONAR SEDE ------------- */
    //saber si el boton ACEPTAR de seleccionde SEDE a sido inicializado
    if (isset($_POST['btn-select-SE'])) 
    {
        $_SESSION['id_sede']=$_POST['id_sede'];
        $show_combox_grupo = "show";
        $show_combox_grado = "show";
    }
    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_sede']))
    {
        $id_sede = $_SESSION['id_sede'];
    }
/* ----------- FIN SELECCIONAR SEDE ----------- */


/* ------------- SELECCIONAR GRADO ------------- */
    //saber si el boton ACEPTAR de seleccionde GRUPO sido inicializado
    if (isset($_POST['btn-select-GRA'])) 
    {
        $_SESSION['id_grado']=$_POST['id_grado'];
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_grado']))
    {
        $id_grado = $_SESSION['id_grado'];
    }
/* ----------- FIN SELECCIONAR GRADO ----------- */





/* ------------- SELECCIONAR GRUPO ------------- */
    //saber si el boton ACEPTAR de seleccionde GRUPO sido inicializado
    if (isset($_POST['btn-select-GRU'])) 
    {
        $_SESSION['id_grupo']=$_POST['id_grupo'];
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_grupo']))
    {
        $id_grupo = $_SESSION['id_grupo'];
    }
/* ----------- FIN SELECCIONAR GRUPO ----------- */



/* ------------- SELECCIONAR ALUMNO ------------- */
    //saber si el boton ACEPTAR de seleccionde ALUMNO sido inicializado
    if (isset($_POST['btn-select-AL'])) 
    {
        $_SESSION['id_alumno']=$_POST['id_alumno'];
        $_SESSION['nom_alumno']=$nom_alumno;
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_alumno']))
    {
        $alumno_id = $_SESSION['id_alumno'];
        $nombre_alu = $_SESSION['nom_alumno'];
    }
/* ----------- FIN SELECCIONAR ALUMNO ----------- */



    //Saber si si la variable ID_SEDE E ID_GRUPO
    if (isset($id_opcion))
    {
        switch ($id_opcion) 
        {
            case 'Sede':
                $show_combox_sede       = "show";
                $show_combox_grupo      = "none";
                $show_combox_grado      = "none";
                $show_combox_individual = "none";

                $anio_lectivo_sede = $object->Read_anio_lectivo_sede($id_sede);

                break;

            case 'Grado':
                $show_combox_sede       = "show";
                $show_combox_grupo      = "none";
                $show_combox_individual = "none";

                $anio_lectivo_sede = $object->Read_anio_lectivo_sede($id_sede);
                
                break;

            case 'Grupo':
                $show_combox_sede       = "show";
                $show_combox_grado      = "none";
                $show_combox_individual = "none";

                $anio_lectivo_sede = $object->Read_anio_lectivo_sede($id_sede);
                break;

            case 'Individual':
                $show_combox_grupo = "none";
                $show_combox_sede  = "show";
                $show_combox_grado = "none";

                $anio_lectivo_sede = $object->Read_anio_lectivo_sede($id_sede);
                break;
            
            default:
                # code...
                break;
        }
    }

if (isset($id_sede))
{
    if ($id_opcion == "Sede")
    {
        $show_opciones_sede = "show";
    }
    elseif ($id_opcion == "Grado")
    {
        $show_combox_grado = "show";
    }
    elseif ($id_opcion == "Grupo" OR $id_opcion == "Individual")
    {
        $show_combox_grupo = "show";
    }
    elseif ($id_opcion == "Individual")
    {
        $show_combox_individual = "show";
    }


    $grupos = $object->Read_grupos_sede($id_sede);
    $nombre_sede = $object->nombre_sede($id_sede);


    if (isset($id_grupo))
    {
        $nombre_grupo = $object->nombre_grupo($id_grupo);

        foreach ($nombre_grupo as $nombre_grupo) 
        {
            # code...
        }

    }


    if (isset($nombre_alumno))
    {
        $nombre_alumno = $object->nombre_alumno($alumno_id);

        foreach ($nombre_alumno as $nombre_alumno) 
        {
            # code...
        }
    }   
    

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
                            Informes <small>Informes de desempeño por periodo</small>
                        </h2>
                        
                        <?php 
                        if (isset($id_opcion) AND $id_opcion != "")
                        { 
                            echo "<h5>Informe por ".$id_opcion."</h5>";
                        }
                        else
                        {
                            ?>
        <!-- form para seleccionar TIPO INDORME  -->
                            <form style="margin-bottom: 2px;" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group" style="margin-bottom: 2px;">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="opcion" id="getSede">
                                                        <option value="">-- Seleccione Opcion --</option>
                                                        <option value="Sede">Informe por Sede</option>
                                                        <option value="Grado">Informe por Grado</option>
                                                        <option value="Grupo">Informe por Grupo</option>
                                                        <option value="Individual">Informe Individual</option>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn bg-teal waves-effect" type="submit" name="btn-select-OP">Aceptar</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                        
                        } 
                        ?>
                        <?php

            /*-------------------------- COMBOBOX SEDE --------------------*/ 
                        if (isset($id_sede))
                        {
                            echo "<h5>".$nombre_sede['descripcion_sede']."</h5>";

                            if ($id_opcion == "Sede")
                            {
                               ?>
                                <div class="align-right">
                                    <form id="destroy_variables" method="POST">
                                        <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Opcion</button>
                                    </form>
                                </div>
                                <?php
                            }
                             
                        }
                        else
                        {
                            ?>
                            <!-- form para seleccionar GRUPO por ASIGNATURA -->
                            <div  style="display: <?php echo $show_combox_sede; ?>;">
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
                            </div>
                            <?php
                        
                        } 
                        ?>
                       
                        <?php 

            /*-------------------------- COMBOBOX GRADO --------------------*/

                        if (isset($id_grado) )
                        { 
                            if ($id_opcion == "Grado")
                            {
                                echo "<h5>Grado: ".$id_grado."</h5>";
                                $show_opciones_sede = "show";

                               ?>
                                <div class="align-right">
                                    <form id="destroy_variables" method="POST">
                                        <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Opcion</button>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            ?> 
                            <div  style="display: <?php echo $show_combox_grado; ?>;">
                                <!-- form para seleccionar GRUPO por ASIGNATURA -->
                                <form style="margin-bottom: 2px;" method="POST">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group" style="margin-bottom: 2px;">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="id_grado" id="getGrado">
                                                            <option value="">-- Seleccione Grado --</option>
                                                            <?php 
                                                            if (count($grupos) > 0) 
                                                            {                 
                                                                foreach ($grupos as $grupo)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $grupo['id_grado']; ?>"><?php echo $grupo['id_grado']; ?></option>'; 
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                    <option value=""><p class="col-pink">Sin Grados en la Sede</p></option>';
                                                                <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <button class="btn bg-teal waves-effect" type="submit" name="btn-select-GRA">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php 
                        } 
                        ?>


                        <?php 

            /*-------------------------- COMBOBOX GRUPO --------------------*/

                        if (isset($id_grupo) )
                        { 
                             $alumno = $object->Read_alumnos_grupo($id_grupo);

                            if ($id_opcion == "Grupo")
                            {
                                echo "<h5>".$nombre_grupo['descripcion_grupo']."</h5>";
                                $show_opciones_sede = "show";

                               ?>
                                <div class="align-right">
                                    <form id="destroy_variables" method="POST">
                                        <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Opcion</button>
                                    </form>
                                </div>
                                <?php
                            }

                            if ($id_opcion == "Individual")
                            {
                                echo "<h5>".$nombre_grupo['descripcion_grupo']."</h5>";
                                $show_combox_individual = "show";
                            }
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
                                                                    <option value="<?php echo $grupo['id_grupo']; ?>"><?php echo $grupo['descripcion_grupo']; ?></option>'; 
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
                                            <button class="btn bg-teal waves-effect" type="submit" name="btn-select-GRU">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php 
                        } 
                        ?>

                    
                    <?php 

             /*-------------------------- COMBOBOX ALUMNO --------------------*/

                        if (isset($alumno_id) )
                        { 
                            if ($id_opcion == "Individual")
                            {
                                echo "<h5>".$nombre_alumno['nombres'].' '.$nombre_alumno['primer_apellido']. ' ' .$nombre_alumno['segundo_apellido']."</h5>";
                                $show_opciones_sede = "show";

                               ?>
                                <div class="align-right">
                                    <form id="destroy_variables" method="POST">
                                        <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Opcion</button>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            ?> 
                            <div  style="display: <?php echo $show_combox_individual; ?>;">
                                <!-- form para seleccionar GRUPO por ASIGNATURA -->
                                <form style="margin-bottom: 2px;" method="POST">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group" style="margin-bottom: 2px;">
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="id_alumno" id="getAlumno">
                                                            <option value="">-- Seleccione Alumno --</option>
                                                            <?php 
                                                            if (count($alumno) > 0) 
                                                            {                 
                                                                foreach ($alumno as $alumno)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $alumno['id_alumno']; ?>"><?php echo $alumno['nombres'].' '.$alumno['primer_apellido']. ' ' .$alumno['segundo_apellido']; ?></option>'; 
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
                                            <button class="btn bg-teal waves-effect" type="submit" name="btn-select-AL">Aceptar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php 
                        } 
                        ?>

                    </div>

                    
 <!-- ***************** OPCIONES INFORME ***************** --> 
                    <div class="body" style="display: <?php echo $show_opciones_sede; ?>;">

                        
                        <div class="body" >
                            
                            <h2 class="card-inside-title">Opciones Imprecion Informe</h2>


                            <form id="informe" method="POST" action="reporte.php">

                                <input type="hidden" name="opcion" id="opcion" class="form-control" value="<?php echo $id_opcion; ?>">
                                <input type="hidden" name="id_sede" id="id_sede" class="form-control" value="<?php if (isset($id_sede)) {echo $id_sede;}  ?>">

                            <!-- Para Informe por Grupo -->
                                <input type="hidden" name="id_grado" id="id_grado" class="form-control" value="<?php if (isset($id_grado)) {echo $id_grado;}  ?>">

                            <!-- Para Informe por Grado -->
                                <input type="hidden" name="id_grupo" id="id_grupo" class="form-control" value="<?php if (isset($id_grupo)) {echo $id_grupo;}  ?>">

                            <!-- Para Informe Individual -->
                                <input type="hidden" name="alumno_id" id="alumno_id" class="form-control" value="<?php if (isset($alumno_id)) {echo $alumno_id;}  ?>">
                                                               
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon font-12">Año Lectivo</span>
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="id_anio_lectivo" id="getAnio" required>
                                                <option value="">-- Seleccione Año Lectivo --</option>
                                                <?php 

                                                if (count($anio_lectivo_sede)>0)
                                                {
                                                    foreach ($anio_lectivo_sede as $anio_lectivo_sede) 
                                                    {
                                                        echo '<option value="'.$anio_lectivo_sede['id_anio_lectivo'].'">'.$anio_lectivo_sede['id_anio_lectivo'].'</option>';
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<option value="">Sin Año Lectivo</option>';
                                                }  
                                    
                                                ?>    
                                                }
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            

                        
                                <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_periodo" id="getPeriodo" required>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            

                            
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon font-12">Tipo Papel</span>
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="papel" id="papel" required>
                                                <option value="Letter">Carta</option>
                                                <option value="Legal">Oficio</option>';   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                    

                                <div class="row clearfix">

                                    <div class="col-sm-12 align-center">
                                        <button class="btn bg-teal waves-effect" type="submit" name="informe">Generar Informe</button>
                                    </div>

                                </div>
                                

                            </form>
                            
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


<script type="text/javascript">
    $(document).ready(function()
    {       
        
    //----------FUNCION SELECCIONAR DOCENTE--------------
        // function to get all records from table
        function getAll(){
            
            $.ajax
            ({
                url: 'getPeriodoAnio.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#getPeriodo").html(r);
                }
            });         
        }
        
        getAll();
        // function to get all records from table
        
        
        // code to get all records from table via select box
        $("#getAnio").change(function()
        {               
            var id = $(this).find(":selected").val();

            var dataString = 'action='+ id;
                    
            $.ajax
            ({
                url: 'getPeriodoAnio.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#getPeriodo").html(r);
                } 
            });
        })
        // code to get all records from table via select box

    });
    </script>