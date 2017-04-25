<?php 
require_once("class.user.php");

$user           = new USER();
$cabecera       = new USER();
$logros_alumnos = new USER();
$nota           = new USER();
$falta          = new USER();
$logros         = new USER();
$newLogro       = new USER();
$updateLogro    = new USER();
$object         = new USER();
$fechas         = new USER();
$asig_id        = new USER();
$alumnos_grupo  = new USER();


$show_table_alumnos = "show";
$show_table_logros  = "show";
$data_select  = " ";

include("../includes/header.php");?>
<!-- #Top Bar -->



<!-- Menu -->
<?php 
    include("../includes/menu.php");

    //saber si el boton CREAR de logro a sifo inicializado
    if (isset($_POST['btn-select-GR'])) 
    {
        $_SESSION['id_asignatura']=$_POST['id_asignatura'];    
    }

    if (isset($_SESSION['id_asignatura']))
    {
        $id_asignatura = $_SESSION['id_asignatura'];
    }


if (isset($id_asignatura))
{
    $cabecera = $object->Read_cabecera_grupo($user_id,$id_asignatura);
    
    
    // Cargar datos en un array con CABECERA
    if (count($cabecera) > 0) 
    {
                    
        foreach ($cabecera as $cabecera) 
        {
            $show_table_alumnos= "show";
        }
    }

    //saber si la variable $id_asignatura fue inicializada
    if (isset($id_asignatura))
    {
        $alumnos_grupo = $object->Read_alumnos_grupo($user_id,$id_asignatura);

        //llamando a la funcion read logros para cargar los losgros por asignatura
        $logros      = $object->read_logros($id_asignatura);
        $fechas      = $object->Read_fecha_periodos($cabecera['id_anio_lectivo']);
        $list_logros = "<ol>";
        $res_logros  = " ";
        
    }


    // Saber si logros ha sido inicializado
    if (count($logros) > 0)
    {
        $i=1;
        foreach ($logros as $logros)
        {
            $list_logros .='<li>' . '<b class="font-10">[' .$logros['id_logro']. ']</b> ' . $logros['descripcion']  .'
                            
                            <div class="btn-group dropdown">
                                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">more_horiz</i>
                                <ul class="dropdown-menu pull-left">
                                    <li><a class="open-EditRow" data-toggle="modal" data-target="#Update-Logro" data-id="'.$logros['id_logro'].'" data-desc="'.$logros['descripcion'].'" data-asig="'.$id_asignatura.'"><i class="material-icons">mode_edit</i>Editar</a></li>
                                    <li><a id="del_logro" data-id="'.$logros['id_logro'].'" href="javascript:void(0)"><i class="material-icons">delete</i>Eliminar</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-sm btn-danger" id="del_logro" data-id="'.$logros['id_logro'].'" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                                    </li>
                                </ul>
                            </div>
                            </li>';

            $res_logros .='<option value="' .$logros['id_logro']. '">' .$logros['id_logro']. '</option>';

            $i++;
        }

        // Saber si res_logros ha sido inicializado
        if (isset($List_logros)) 
        {
            $list_logros .= "</ol>";
        }
        
    }
    else
    {
        $list_logros = "No hay logros para Mostrar.";
    }

    // Sber si alumnos_grupo esta vacio
    if (count($alumnos_grupo) > 0) 
    {
                    
        foreach ($alumnos_grupo as $alumnos_grupo) 
        {
            

            // Saber si $id_asignatura & $cabecera['id_alumno'] han sido inicializados
            if (isset($id_asignatura) and isset($alumnos_grupo['id_alumno']))
            {                
                $logros_alumnos = $object->Read_logros_alumno($id_asignatura,$alumnos_grupo['id_alumno']);                
            }

            /** Saber si $logros_alunos han sido inicializados y hay registros encontrados**/
            if (isset($logros_alumnos) and count($logros_alumnos) > 0)
            {
                foreach ($logros_alumnos as $logros_alumnos)
                {
                    $res_logros_alumno = $logros_alumnos['id_logros']. '<br>';
                }
            }
            else
            {
                $res_logros_alumno = "No hay logros.";
            }

            //saber si se han iniciado las variables de alumno
            if (isset($alumnos_grupo['primer_apellido']) and isset($alumnos_grupo['segundo_apellido']) and isset($alumnos_grupo['nombres']) and isset($alumnos_grupo['id_alumno']) and isset($id_asignatura) and isset($cabecera['id_anio_lectivo']))
            {
                $data_select .= '<option value="' . $alumnos_grupo['id_alumno'] . '">' . $alumnos_grupo['primer_apellido'] . ' ' .$alumnos_grupo['segundo_apellido'] . ' ' .$alumnos_grupo['nombres'] .'</option>';
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
                            Asignaturas <small>Lista de Estudientes Por Asignaturas</small>
                        </h2>
                        
                        <!-- form para seleccionar GRUPO por ASIGNATURA -->
                        <form style="margin-bottom: 2px;" method="POST">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group" style="margin-bottom: 2px;">
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="id_asignatura">
                                                    <option value="">-- Seleccione Grupo --</option>
                                                    <?php 
                                                        $user = $object->combobox_grupos_docente($user_id);
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


                    <div class="body" >                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card">
                        <div class="body" style="padding-top: 10px;">
                        
                        <!-- Boton para cargar collpse de LOGOS -->
                            <div class='col-sm-12'>
                                <button class="btn bg-cyan waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Logros</button>

                                <button type='button' class='btn bg-teal waves-effect' data-toggle='modal' data-target='#NewLogro'>Nuevo Logro</button>
                            </div>

                            <!--Boton crear Nuevo Logro-->
                            

                            <div class="collapse" id="collapseExample">
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

                                </form>                            
                            </div>

                        </div>
                    </div>
                </div><!-- Fin div SHOW-->

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
