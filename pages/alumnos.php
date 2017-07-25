<?php 
require_once("class.user.php");

$object            =   new USER();
$nombre_sede       =   new USER();
$alumnos_sede      =   new USER();
$estado            =   new USER();
$desc_grupo_alumno = new USER();

$show_table_alumnos = "none";
$show_table_logros  = "none";
$show_combox_grupo  = "none";
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
        $_SESSION['id_sede_asig_alum_grupo']=$_POST['id_sede'];
        $show_table_alumnos = "show";
    }


    //saber si el boton CAMBIAR SEDE Y GRUPO a sido inicializado
    if (isset($_POST['btn-select-destroy'])) 
    {
        $_SESSION['id_sede_asig_alum_grupo'] = null;
    }

    //Saber si si la variable de session ID_SEDE
    if (isset($_SESSION['id_sede_asig_alum_grupo']))
    {
        $id_sede = $_SESSION['id_sede_asig_alum_grupo'];
    }

    //Saber si si la variable ID_SEDE E ID_GRUPO
    if (isset($id_sede))
    {        
        $num = 1;
           
        $alumnos_sede = $object->Read_alumno_sede($id_sede);
        $nombre_sede = $object->nombre_sede($id_sede);

        $data = "";
        // Design initial table header
        $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable display nowrap"" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nombre Estudiente</th>
                                    <th>Codigo</th>
                                    <th>Grupo</th>
                                    <th>Nombre Padre</th>
                                    <th>Tel. Padre</th>
                                    <th>Nombre Madre</th>
                                    <th>Tel. Madre</th>
                                    <th>Sisben</th>
                                    <th>Fecha Matricula</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            <thead>
                            <tbody>
                            ';

        // Saber si alumnos_sede esta vacio
        if (count($alumnos_sede) > 0) 
        {
            $show_table_alumnos = "show";

            foreach ($alumnos_sede as $alumnos_sede) 
            {
                //saber si se han iniciado las variables de alumno
                if (isset($alumnos_sede['primer_apellido']) and isset($alumnos_sede['segundo_apellido']) and isset($alumnos_sede['nombres']) and isset($alumnos_sede['id_alumno']))
                {

                    $estado  = $object->descripcion_estado($alumnos_sede['id_estado']);
                    $desc_grupo_alumno = $object->Descripcion_grupo_alumno($alumnos_sede['id_alumno']);

                    $data .= '
                        <tr>
                            <td>' . $num. '</td>
                            <td>' . $alumnos_sede['primer_apellido'] . ' ' .$alumnos_sede['segundo_apellido'] . ' ' .$alumnos_sede['nombres'] .'</td>
                            <td>' . $alumnos_sede['id_alumno'] . '</td>';

                            if (count($desc_grupo_alumno) > 0)
                            {
                                foreach ($desc_grupo_alumno as $desc_grupo_alumno)
                                {
                                   $data .= '<td>' . $desc_grupo_alumno['descripcion_grupo'] . '</td>';
                                }
                            }
                            else
                            {
                                 $data .= '<td>Sin Grupo</td>';
                            }
                                

                    $data .= '
                            <td>' . $alumnos_sede['full_name_padre'] . '</td>
                            <td>' . $alumnos_sede['telefono_padre'] . '</td>
                            <td>' . $alumnos_sede['full_name_madre'] . '</td>
                            <td>' . $alumnos_sede['telefono_madre'] . '</td>
                            <td>' . $alumnos_sede['sisben'] . '</td>
                            <td>' . $alumnos_sede['fecha_matricula'] . '</td>';

                            foreach ($estado as $estado)
                            {
                               $data .= '<td>' . $estado['descripcion'] . '</td>';
                            }


                     $data .= '
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn bg-orange dropdown-toggle btn-xs waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="open-EditRow" data-toggle="modal" data-target="#Detalle-Alumno" alumno_id="'.$alumnos_sede['id_alumno'].'" alumno_names="'.$alumnos_sede['nombres'].'" alumno_prim_ape="'.$alumnos_sede['primer_apellido'].'" alumno_seg_ape="'.$alumnos_sede['segundo_apellido'].'" alumno_desplazado="'.$alumnos_sede['desplazado'].'" alumno_repitente="'.$alumnos_sede['repitente'].'" alumno_sisben="'.$alumnos_sede['sisben'].'" alumno_full_name_padre="'.$alumnos_sede['full_name_padre'].'" alumno_telefono_padre="'.$alumnos_sede['telefono_padre'].'" alumno_full_name_madre="'.$alumnos_sede['full_name_madre'].'" alumno_telefono_madre="'.$alumnos_sede['telefono_madre'].'" alumno_fecha_matricula="'.$alumnos_sede['fecha_matricula'].'" >Detalles</a></li>
                                        <li><a class="open-EditRow" data-toggle="modal" data-target="#Update-Alumno" alumno_id="'.$alumnos_sede['id_alumno'].'" alumno_names="'.$alumnos_sede['nombres'].'" alumno_prim_ape="'.$alumnos_sede['primer_apellido'].'" alumno_seg_ape="'.$alumnos_sede['segundo_apellido'].'" alumno_desplazado="'.$alumnos_sede['desplazado'].'" alumno_repitente="'.$alumnos_sede['repitente'].'" alumno_sisben="'.$alumnos_sede['sisben'].'" alumno_full_name_padre="'.$alumnos_sede['full_name_padre'].'" alumno_telefono_padre="'.$alumnos_sede['telefono_padre'].'" alumno_full_name_madre="'.$alumnos_sede['full_name_madre'].'" alumno_telefono_madre="'.$alumnos_sede['telefono_madre'].'" alumno_fecha_matricula="'.$alumnos_sede['fecha_matricula'].'" >Editar</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="javascript:void(0);">Separated link</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>';
                    $num++;
                }            
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
                            Asignar Alumnos a Grupos <small>Lista de Estudientes Por Grupo</small>
                        </h2>
                        
                        <?php 
                        if (isset($id_sede))
                        { 
                            echo "<h5>".$nombre_sede['descripcion_sede']."</h5>";
                        ?>
                            <div class="align-right">
                                <form id="destroy_variables" method="POST">
                                    <button class="btn bg-teal btn-xs waves-effect" type="submit" name="btn-select-destroy">Cambiar Sede</button>
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
                        
                        } 
                        ?>
                    </div>
                </div>                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card" >
                        <div class="body" >

                            <div id="miTabla">
                                    <?php echo $data; ?>
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
    </section>

<!-- TFooter -->
<?php include("../includes/footer.php");?>
<!-- #Footer -->

<!-- test datos to modal-->
<script type="text/javascript">
    $('.open-EditRow').click(function(){
       var alumno_id = $(this).attr('alumno_id');
       var alumno_names = $(this).attr('alumno_names');
       var alumno_prim_ape = $(this).attr('alumno_prim_ape');
       var alumno_seg_ape = $(this).attr('alumno_seg_ape');
       var alumno_desplazado = $(this).attr('alumno_desplazado');
       var alumno_repitente = $(this).attr('alumno_repitente');
       var alumno_sisben = $(this).attr('alumno_sisben');
       var alumno_full_name_padre = $(this).attr('alumno_full_name_padre');
       var alumno_telefono_padre = $(this).attr('alumno_telefono_padre');
       var alumno_full_name_madre = $(this).attr('alumno_full_name_madre');
       var alumno_telefono_madre = $(this).attr('alumno_telefono_madre');
       var alumno_fecha_matricula = $(this).attr('alumno_fecha_matricula');
       $('#register_alumno #alumno_id').val(alumno_id);
       $('#register_alumno #nombres').val(alumno_names);
       $('#register_alumno #primer_apellido').val(alumno_prim_ape);
       $('#register_alumno #segundo_apellido').val(alumno_seg_ape);
       $('#register_alumno #desplazado').val(alumno_desplazado);
       $('#register_alumno #repitente').val(alumno_repitente);
       $('#register_alumno #sisben').val(alumno_sisben);
       $('#register_alumno #full_name_padre').val(alumno_full_name_padre);
       $('#register_alumno #telefono_padre').val(alumno_telefono_padre);
       $('#register_alumno #full_name_madre').val(alumno_full_name_madre);
       $('#register_alumno #telefono_madre').val(alumno_telefono_madre);
       $('#register_alumno #fecha_matricula').val(alumno_fecha_matricula);
    });
</script>


<!-- Modal ACTUALIZAR ALUMNO -->
    <div class="modal fade" id="Update-Alumno" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Informacion Alumno</h4>
                </div>
                <div class="modal-body">
                    <form id="register_alumno" method="POST">

                        <h6 class="card-inside-title">Informacion Alumno</h6>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="alumno_id" id="alumno_id" placeholder="Statu Focused" required>
                                        <label class="form-label">No. Documento*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="nombres" id="nombres" required>
                                        <label class="form-label">Nombres*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="primer_apellido" id="primer_apellido" required>
                                        <label class="form-label">Primer Apellido*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido" required>
                                        <label class="form-label">Segundo Apellido*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="desplazado" name="desplazado" type="checkbox" value="Si">
                                        <label for="desplazado">Desplazado</label>
                            
                                        <input id="repitente" name="repitente" type="checkbox" value="Si">
                                        <label for="repitente">Repitente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="sisben" id="display">
                                            <option value="">-- Nivel Sisben --</option>
                                            <option value="0">Nivel 0</option>
                                            <option value="1">Nivel 1</option>';
                                            <option value="2">Nivel 2</option>';
                                            <option value="3">Nivel 3</option>';    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="id_sede" id="getSede" required>
                                            <option value="">-- Seleccione Sede --</option>
                                            <?php 
                                                $user = $object->combobox_sede();
                                             ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="id_grupo" id="getGrupo">
                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line focused">
                                        <input type="text" name="fecha_matricula" id="fecha_matricula" class="datepicker form-control" placeholder="Seleccionar Fecha...">
                                    </div>
                                </div>
                            </div>

                        </div>
                    
                            
                            
                        <h6 class="card-inside-title">Informacion Padres de Familia</h6>

                            <div class="row clearfix">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="full_name_padre" id="full_name_padre" class="form-control" required>
                                            <label class="form-label">Nombre Completo Padre*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="telefono_padre" id="telefono_padre" class="form-control" required>
                                            <label class="form-label">Telefono*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="full_name_madre" id="full_name_madre" class="form-control" required>
                                            <label class="form-label">Nombre Completo Madre*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="telefono_madre" id="telefono_madre" class="form-control" required>
                                            <label class="form-label">Telefono*</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="matricular">Actualizar</button>
                                    <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                                </div>

                            </div>
                                

                        </form>
                </div>
                
            </div>
        </div>
    </div>


<!-- Modal DETALLES ALUMNO -->
    <div class="modal fade" id="Detalle-Alumno" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Informacion Alumno</h4>
                </div>
                <div class="modal-body">
                    <form id="register_alumno" method="POST">

                        <h6 class="card-inside-title">Informacion Alumno</h6>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line>
                                    	<span class="input-group-addon"><label class="form-label">No. Documento*</label></span>
                                        <spam name="alumno_id" id="alumno_id"></spam>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="nombres" id="nombres" disabled>
                                        <label class="form-label">Nombres*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="primer_apellido" id="primer_apellido" disabled>
                                        <label class="form-label">Primer Apellido*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido" required>
                                        <label class="form-label">Segundo Apellido*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="desplazado" name="desplazado" type="checkbox" value="Si">
                                        <label for="desplazado">Desplazado</label>
                            
                                        <input id="repitente" name="repitente" type="checkbox" value="Si">
                                        <label for="repitente">Repitente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="sisben" id="display">
                                            <option value="">-- Nivel Sisben --</option>
                                            <option value="0">Nivel 0</option>
                                            <option value="1">Nivel 1</option>';
                                            <option value="2">Nivel 2</option>';
                                            <option value="3">Nivel 3</option>';    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="id_sede" id="getSede" required>
                                            <option value="">-- Seleccione Sede --</option>
                                            <?php 
                                                $user = $object->combobox_sede();
                                             ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <select class="form-control show-tick" name="id_grupo" id="getGrupo">
                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line focused">
                                        <input type="text" name="fecha_matricula" id="fecha_matricula" class="datepicker form-control" placeholder="Seleccionar Fecha...">
                                    </div>
                                </div>
                            </div>

                        </div>
                    
                            
                            
                        <h6 class="card-inside-title">Informacion Padres de Familia</h6>

                            <div class="row clearfix">

                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="full_name_padre" id="full_name_padre" class="form-control" required>
                                            <label class="form-label">Nombre Completo Padre*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="telefono_padre" id="telefono_padre" class="form-control" required>
                                            <label class="form-label">Telefono*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="full_name_madre" id="full_name_madre" class="form-control" required>
                                            <label class="form-label">Nombre Completo Madre*</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" name="telefono_madre" id="telefono_madre" class="form-control" required>
                                            <label class="form-label">Telefono*</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="matricular">Actualizar</button>
                                    <button type="button" class="btn btn-block btn-lg bg-amber waves-effect" data-dismiss="modal">Cancelar</button>
                                </div>

                            </div>
                                

                        </form>
                </div>
                
            </div>
        </div>
    </div>