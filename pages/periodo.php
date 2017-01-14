<?php 
require_once("class.user.php");
$periodos = new USER();
$object = new USER();

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
            
            <!-- Metarial Design Buttons -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Periodos <small>Lista de periodos</small>
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
                        
                            <!-- LISTAR ALUMNOS -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Descipcion</th>
                                                            <th>Fecha de Inicio</th>
                                                            <th>Fecha de Finalizacion</th>
                                                            <th>Año Lecivo</th>
                                                        </tr>
                                                    <thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Descipcion</th>
                                                            <th>Fecha de Inicio</th>
                                                            <th>Fecha de Finalizacion</th>
                                                            <th>Año Lecivo</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $periodos = $object->Read_periodo();
                                 
                                if (count($periodos) > 0) 
                                {
                                    foreach ($periodos as $periodo) {
                                        $data .= '<tr>
        
                                                <td>' . $periodo['id_periodo'] . '</td>
                                                <td>' . $periodo['desc_periodo'] . '</td>
                                                <td>' . $periodo['fecha_inicio'] . '</td>
                                                <td>' . $periodo['fecha_fin'] . '</td>
                                                <td>' . $periodo['descripcion_anio_lectivo'] . '</td>
                                                <td>

                                                
                                                    <button data-toggle="modal" data-target="#view-modal" data-id="'.$periodo['id_periodo'].'" id="getUser" class="btn btn-primary btn-xs waves-effect"><i class="material-icons">info_outline    </i></button>

                                                    <button data-toggle="modal" data-target="#view-modal" data-id="' . $periodo['id_periodo'] . '" id="getUser" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i> View</button>

                                                
                                                    <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#DetallesAlumno" name="Detalles" onclick="' . $periodo['id_periodo'] . '"><i class="material-icons">mode_edit</i></button>
                                                
                                                </td>
                                            </tr>';

                                    }
                                } else {
                                    // records not found
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }
                                 
                                $data .= '<tbody></table>';
                                 
                                echo $data;
                                
                            ?>
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->