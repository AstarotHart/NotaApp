<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$alumno = new USER();

$object = new USER();


 ?>



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
                                Alumnos <small>Lista de alumnos</small>
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
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Id Grado</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    <thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombres</th>
                                                            <th>Primer Apellido</th>
                                                            <th>Segundo Apellido</th>
                                                            <th>Id Grado</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $alumnos = $object->Read_alumno();
                                 
                                if (count($alumnos) > 0) 
                                {
                                    foreach ($alumnos as $alumno) {
                                        $data .= '<tr>
        
                                                <td>' . $alumno['id_alumno'] . '</td>
                                                <td>' . $alumno['nombres'] . '</td>
                                                <td>' . $alumno['primer_apellido'] . '</td>
                                                <td>' . $alumno['segundo_apellido'] . '</td>
                                                <td>' . $alumno['id_grado'] . '</td>
                                                <td>
                                                    <button onclick="detalles_alumno(' . $alumno['id_alumno'] . ')" class="btn btn-warning">Update</button>
                                                </td>
                                                <td>
                                                    <button onclick="DeleteUser(' . $alumno['id_alumno'] . ')" class="btn btn-danger">Delete</button>
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
                        <!-- #LISTAR ALUMNOS -->
                        </div>
                    </div>                

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->