<?php 
require_once("class.user.php");
$asignatura = new USER();
$object = new USER();

$show_table= "none";

if (isset($_POST['crear'])) 
{
    $id_area            = $_POST['id_area'];
    $nombre_asignatura  = $_POST['nombre_asignatura'];
    $intensidad_horaria = $_POST['intensidad_horaria'];
    $porcentaje         = $_POST['porcentaje'];

    /**
     * Llamada a funcion para actualizar los datos del docente
     */
    if(($asignatura->register_asignaturas($id_area,$nombre_asignatura,$intensidad_horaria,$porcentaje))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Asignatura Creada","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';

     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Asignatura NO Creada","","error");';
        echo '}, 1000);</script>';
     }

}

//saber si el boton ASIGNAR_DOCENTE_ASIGNATURA ha sido inicializado
if (isset($_POST['actualizar_logro'])) 
{
    $id_logro_act=$_POST['id_logro'];
    $logro=$_POST['logro'];
    $id_asignatura=$_POST['id_asignatura'];
    
     //Llamada a funcion para crear nuevo LOGRO
     
    if(($updateLogro->update_logro($id_logro_act,$logro,$id_asignatura))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro Actualizado.","","success");';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro NO Actualizado.","","error");';
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
                                Asignaturas <small>Lista de Asignaturas por intitucion Educativa</small>
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

                        $id_sede = "IE";
                        $asignaturas = $object->Read_asignaturas_sede($id_sede);

                                 
                            if (count($asignaturas) > 0) $show_table= "show";
                    ?>

                        <!-- Div mostrar u ocultar tablas -->
                        <div  style="display: <?php echo $show_table; ?>;">
                        <!-- LISTAR AREAS -->
                            <?php
                                 
                                // Design initial table header
                                $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable display nowrap"" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>
                                                            <th>Area</th>
                                                            <th>Intesidad Horaria</th>
                                                            <th>Porcentaje</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    <thead>

                                                    <tbody>

                                                    ';
                                 
                                 
                                if (count($asignaturas) > 0) 
                                {   

                                    foreach ($asignaturas as $asignatura) {
                                        $data .=    '<tr>
        
                                                        <td>' . $asignatura['id_asignatura'] . '</td>
                                                        <td>' . $asignatura['nombre_asignatura'] . '</td>                                                    
                                                        <td>' . $asignatura['nombre_area'] . '</td>
                                                        <td>' . $asignatura['intensidad_horaria'] . '</td>
                                                        <td>' . $asignatura['porcentaje'] . '</td>
                                                        <td>
                                                            <div class="btn-group" role="group">

                                                                <button type="submit" class="btn btn-warning btn-xs waves-effect" data-toggle="modal" data-target="#Asignar_docente" name="Detalles" onclick="' . $asignatura['id_asignatura'] . '"><i class="material-icons">mode_edit</i></button>

                                                                <button type="submit" class="btn btn-danger btn-xs waves-effect" data-toggle="modal" data-target="#Detallesarea" name="Detalles" onclick="' . $asignatura['id_asignatura'] . '"><i class="material-icons">delete</i></button>
                                                            </div>
                                                        
                                                        </td>
                                                    </tr>';

                                    }
                                } else {
                                    $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
                                }
                                 
                                $data .= '<tbody></table>';
                                 
                                echo $data;
                                
                            ?>
                            </div><!-- Fin DIV ocultar o mostrar tabla -->

                            <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#New_Area">Nueva Asignatura</button>
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
                    $("#display").html(r);
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
                    $("#display").html(r);
                } 
            });
        })
        // code to get all records from table via select box


    //----------FUNCION SELECCIONAR AREA--------------

        function getAllArea(){
            
            $.ajax
            ({
                url: 'getAreaAsignaturas.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#display2").html(r);
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
                url: 'getAreaAsignaturas.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#display2").html(r);
                } 
            });
        })
        // code to get all records from table via select box
        

        //----------FUNCION SELECCIONAR GRUPO--------------

        function getAllGrupo(){
            
            $.ajax
            ({
                url: 'getGrupoAsignatura.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#display3").html(r);
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
                url: 'getGrupoAsignatura.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#display3").html(r);
                } 
            });
        })
        // code to get all records from table via select box
        

        //----------FUNCION SELECCIONAR ANIO LECTIVO--------------

        function getAllGrupo(){
            
            $.ajax
            ({
                url: 'getAnioLectivo.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#display3").html(r);
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
                url: 'getAnioLectivo.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#display4").html(r);
                } 
            });
        })
        // code to get all records from table via select box
    });
    </script>



    <!-- Modal crear nueva ASIGNATURA -->
    <div class="modal fade" id="New_Area" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nueva Asignatura</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">dns</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_area" id="display2">
                            </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nombre_asignatura" placeholder="Nombre Asignatura" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">watch_later</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="intensidad_horaria" placeholder="Intesidad Horaria" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">show_chart</i>
                            </span>
                            <div class="form-line">
                                <input type="number" min="0" max="100" value="50" class="form-control" name="porcentaje" placeholder="Porcentaje" required autofocus>
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


    <!-- Modal Accignar Docente a Asignatura -->
    <div class="modal fade" id="Asignar_docente" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nueva Asignatura</h4>
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
                                <i class="material-icons">dns</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_area" id="display2">
                            </select>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">label</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="id_grupo" id="display3">
                            </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nombre_asignatura" placeholder="Nombre Asignatura" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">watch_later</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="intensidad_horaria" placeholder="Intesidad Horaria" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">show_chart</i>
                            </span>
                            <div class="form-line">
                                <input type="number" min="0" max="100" value="50" class="form-control" name="porcentaje" placeholder="Porcentaje" required autofocus>
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