<?php 
require_once("class.user.php");
$grado = new USER();
$object = new USER();

$show_table= "none";

if (isset($_POST['crear'])) 
{
    $id_sede=$_POST['id_sede'];
    $descripcion_grado=$_POST['descripcion_grado'];

    /**
     * Llamada a funcion para actualizar los datos del docente
     */
    if(($grado->register_grados($id_sede,$descripcion_grado))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Grado Creado","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Grado NO Creado","","error");';
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
                                Grados <small>Lista de Grados por intitucion Educativa</small>
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
                        $grados = $object->Read_grados();
                                 
                            if (count($grados) > 0) $show_table= "show";
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
                                                            <th>Nombre</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';
                                 
                                 
                                if (count($grados) > 0) 
                                {
                                    foreach ($grados as $grado) {
                                        $data .=    '<tr>
        
                                                        <td>' . $grado['id_grado'] . '</td>
                                                        <td>' . $grado['descripcion_sede'] . '</td>
                                                        <td>' . $grado['descripcion_grado'] . '</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button data-toggle="modal" data-target="#view-modal" data-id="'.$grado['id_grado'].'" id="getUser" class="btn btn-primary btn-xs waves-effect"><i class="material-icons">info_outline    </i></button>

                                                                <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $grado['id_grado'] . '"><i class="material-icons">mode_edit</i></button>

                                                                <button type="submit" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $grado['id_grado'] . '"><i class="material-icons">delete</i></button>
                                                            </div>
                                                        
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
                            </div><!-- Fin DIV ocultar o mostrar tabla -->

                            <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#New_Area">Nuevo Grado</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Modal Crear nuevo GRADO -->
    <div class="modal fade" id="New_Area" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Grado</h4>
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
                                            $user = $object->combobox_sede();
                                        ?>
                            </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="descripcion_grado" placeholder="Nombre grado" required autofocus>
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

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->