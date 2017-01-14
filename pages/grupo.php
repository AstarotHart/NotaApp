<?php 
require_once("class.user.php");
$grupo = new USER();
$object = new USER();

if (isset($_POST['crear'])) 
{
    $id_grado=$_POST['id_grado'];
    $id_docente=$_POST['id_docente'];
    $nombre_grupo=$_POST['nombre_grupo'];

    /**
     * Llamada a funcion para actualizar los datos del docente
     */
    if(($grupo->register_grupos($id_grado,$id_docente,$nombre_grupo))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("grupo Creada","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("grupo NO Creada","","error");';
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
                                Grupo <small>Lista de Grupos por intitucion Educativa</small>
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

                        <!-- LISTAR AREAS -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>
                                                            <th>Director</th>
                                                            <th>Grado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';
                                 
                                 
                                $grupos = $object->Read_grupos();
                                 
                                if (count($grupos) > 0) 
                                {
                                    foreach ($grupos as $grupo) {
                                        $data .=    '<tr>
        
                                                        <td>' . $grupo['id_grupo'] . '</td>
                                                        <td>' . $grupo['descripcion_grupo'] . '</td>
                                                        <td>' . $grupo['nombres'] . ' ' . $grupo['prim_apellido'] . '</td>
                                                        <td>' . $grupo['id_grado'] . '</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button data-toggle="modal" data-target="#view-modal" data-id="'.$grupo['id_grupo'].'" id="getUser" class="btn btn-primary btn-xs waves-effect"><i class="material-icons">info_outline    </i></button>

                                                                <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $grupo['id_grupo'] . '"><i class="material-icons">mode_edit</i></button>

                                                                <button type="submit" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $grupo['id_grupo'] . '"><i class="material-icons">delete</i></button>
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

                            <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#New_Area">Nuevo Grupo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Jquery Core Js -->
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function()
    {       
        
    //----------FUNCION SELECCIONAR DOCENTE--------------
        // function to get all records from table
        function getAll(){
            
            $.ajax
            ({
                url: 'getDocentesAsignaturas.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#display2").html(r);
                }
            });         
        }
        
        getAll();
        // function to get all records from table
        
        
        // code to get all records from table via select box
        $("#getDocentes").change(function()
        {               
            var id = $(this).find(":selected").val();

            var dataString = 'action='+ id;
                    
            $.ajax
            ({
                url: 'getDocentesAsignaturas.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#display2").html(r);
                } 
            });
        })
        // code to get all records from table via select box


    //----------FUNCION SELECCIONAR AREA--------------

        function getAllArea(){
            
            $.ajax
            ({
                url: 'getGradoGrupo.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#display").html(r);
                }
            });         
        }
        
        getAllArea();
        // function to get all records from table

        // code to get all records from table via select box
        $("#getDocentes").change(function()
        {               
            var id = $(this).find(":selected").val();

            var dataString = 'action='+ id;
                    
            $.ajax
            ({
                url: 'getGradoGrupo.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#display").html(r);
                } 
            });
        })
        // code to get all records from table via select box
    });
    </script>

    <!-- Modal Nuevo GRUPO -->
    <div class="modal fade" id="New_Area" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nuevo Grupo</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_balance</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_sede" id="getDocentes">
                                        <option value="">-- Seleccione Sede --</option>
                                        <?php 
                                            $user = $object->combobox_sede();
                                        ?>
                            </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">layers</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_grado" id="display">
                            </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_docente" id="display2">
                                        
                            </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nombre_grupo" placeholder="Nombre Grupo" required autofocus>
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