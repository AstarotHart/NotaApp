<?php 
require_once("class.user.php");
$anios = new USER();
$object = new USER();

$show_table= "none";

echo "FUCK";

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

    echo "Año lectivo ".$id_anio_lectivo."<br>Dedc Año lectivo ".$descripcion_anio_lectivo."<br>inicio Año lectivo ".$fecha_inicio_anio_lectivo."<br>fin Año lectivo ".$fecha_fin_anio_lectivo."<br>inicio primer periodo ".$fecha_inicio_primer."<br>fin primer periodo ".$fecha_fin_primer."<br>inicio segundo periodo ".$fecha_inicio_segundo."<br>fin segundo periodo ".$fecha_fin_segundo."<br>inicio Tercer periodo ".$fecha_inicio_tercer."<br>fin Tercero periodo ".$fecha_fin_tercer."<br>inicio Cuarto periodo ".$fecha_inicio_cuarto."<br>fin Cuarto periodo ".$fecha_fin_cuarto."<br>Id Sede ".$id_sede."<br>";

    if(($anios->register_anio_periodos($id_anio_lectivo, $descripcion_anio_lectivo, $fecha_inicio_anio_lectivo, $fecha_fin_anio_lectivo, $fecha_inicio_primer, $fecha_fin_primer, $fecha_inicio_segundo, $fecha_fin_segundo, $fecha_inicio_tercer, $fecha_fin_tercer, $fecha_inicio_cuarto, $fecha_fin_cuarto, $id_sede))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Año Lectivo y periodos creados con exito","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';

        $show_table= "show";
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
    <?php include("../includes/menu.php");?>
    <!-- end menu-->

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>
                                Año Lectivo <small>Lista de Años lectivo por sede</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse">
                                        <i class="material-icons">loop</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="body">

                    <?php 
                        $anios = $object->Read_anio_lectivo();
                                 
                            if (count($anios) > 0) $show_table= "show";
                    ?>

                        <!-- Div mostrar u ocultar tablas -->
                        <div  style="display: <?php echo $show_table; ?>;">

                        <!-- LISTAR AREAS -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Sede</th>
                                                            <th>Descripcion</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Finalizacion</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';

                                 
                                if (count($anios) > 0) 
                                {
                                    foreach ($anios as $anio) {
                                        $data .=    '<tr>
        
                                                        <td>' . $anio['id_anio_lectivo'] . '</td>
                                                        <td>' . $anio['descripcion_sede'] . '</td>
                                                        <td>' . $anio['descripcion_anio_lectivo'] . '</td>
                                                        <td>' . $anio['fecha_inicio'] . '</td>
                                                        <td>' . $anio['fecha_fin'] . '</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button data-toggle="modal" data-target="#view-modal" data-id="'.$anio['id_anio_lectivo'].'" id="getUser" class="btn btn-primary btn-xs waves-effect"><i class="material-icons">info_outline    </i></button>

                                                                <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $anio['id_anio_lectivo'] . '"><i class="material-icons">mode_edit</i></button>

                                                                <button type="submit" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $anio['id_anio_lectivo'] . '"><i class="material-icons">delete</i></button>
                                                            </div>
                                                        
                                                        </td>
                                                    </tr>';

                                    }
                                }
                                 
                                $data .= '<tbody></table>';
                                 
                                echo $data;
                                
                            ?>
                            </div><!-- Fin DIV ocultar o mostrar tabla -->

                            <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#New_Anio_Lectivo">Nuevo Año Lectivo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- Modal Actualizar Datos Usuario -->
    <div class="modal fade" id="New_Area" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Actualizar Datos</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_balance</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_sede">
                                        <option value="">-- Seleccione Sede --</option>
                                        <?php 
                                            $anios = $object->combobox_sede();
                                        ?>
                            </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nombre_area" placeholder="Nombre Area" required autofocus>
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


    <!-- For Material Design Colors -->
            <div class="modal fade" id="New_Anio_Lectivo" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">NUEVO AÑO LECTIVO</h4>
                        </div>
                        <div class="modal-body">
                            <form id="Anio_new" method="POST">
                                <h4 class="align-center col-teal">Informacion Nuevo Año Lectivo</h4>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="id_sede" required>
                                                <option value="">-- Seleccione Sede --</option>
                                                <?php 
                                                    $user = $object->combobox_sede();
                                                 ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="codigo_anio_lectivo" required>
                                            <label class="form-label">Codigo Año Lectivo*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="descripcion_anio_lectivo" required>
                                            <label class="form-label">Descripcion*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="date-start" name="fecha_inicio_anio_lectivo" class="date-start form-control" placeholder="Seleccionar Fecha inicio...">
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="date-end" name="fecha_fin_anio_lectivo" class="date-end form-control" placeholder="Seleccionar Fecha Fin...">
                                        </div>
                                    </div>

                                <h4 class="align-center col-teal">Informacion Periodos</h4>

                                    <h6 class="card-inside-title">Primer Periodo</h6>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-start" name="fecha_inicio_primer" class="date-start form-control" placeholder="Seleccionar Fecha inicio...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-end" name="fecha_fin_primer" class="date-end form-control" placeholder="Seleccionar Fecha Fin...">
                                                </div>
                                            </div>
                                        </div>

                                    <h6 class="card-inside-title">Segundo Periodo</h6>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-start" name="fecha_inicio_segundo" class="date-start form-control" placeholder="Seleccionar Fecha inicio...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-end" name="fecha_fin_segundo" class="date-end form-control" placeholder="Seleccionar Fecha Fin...">
                                                </div>
                                            </div>
                                        </div>

                                    <h6 class="card-inside-title">Tercer Periodo</h6>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-start" name="fecha_inicio_tercer" class="date-start form-control" placeholder="Seleccionar Fecha inicio...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-end" name="fecha_fin_tercer" class="date-end form-control" placeholder="Seleccionar Fecha Fin...">
                                                </div>
                                            </div>
                                        </div>

                                    <h6 class="card-inside-title">Cuarto Periodo</h6>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-start" name="fecha_inicio_cuarto" class="date-start form-control" placeholder="Seleccionar Fecha inicio...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="date-end" name="fecha_fin_cuarto" class="date-end form-control" placeholder="Seleccionar Fecha Fin...">
                                                </div>
                                            </div>
                                        </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-block bg-teal waves-effect" type="submit" name="crear">CREAR</button>
                            <button type="button" class="btn btn-block bg-amber waves-effect" data-dismiss="modal">CANCELAR</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>



    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->