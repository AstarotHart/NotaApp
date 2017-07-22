<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$user = new USER();
$object = new USER();

if(isset($_POST['matricular']))
{
    $id_alumno        = strip_tags($_POST['id_alumno']);
    $id_sede          = strip_tags($_POST['id_sede']);
    $id_grupo         = strip_tags($_POST['id_grupo']);
    $nombres          = strip_tags($_POST['nombres']);
    $primer_apellido  = strip_tags($_POST['primer_apellido']);
    $segundo_apellido = strip_tags($_POST['segundo_apellido']);
    $desplazado       = isset($_POST['desplazado']) ? $_POST['desplazado'] : "No" ;
    $repitente        = isset($_POST['repitente']) ? $_POST['repitente'] : "No" ; 
    $sisben        = strip_tags($_POST['sisben']);
    $full_name_padre  = strip_tags($_POST['full_name_padre']);
    $tel_padre        = strip_tags($_POST['telefono_padre']);
    $full_name_madre  = strip_tags($_POST['full_name_madre']);
    $tel_madre        = strip_tags($_POST['telefono_madre']);
    $fecha_matricula        = strip_tags($_POST['fecha_matricula']);


    if (isset($id_sede))
    {
        $anio_actual = $user->anio_actual($id_sede);
    }

    foreach ($anio_actual as $anio_actual)
    {

    }


    if(($user->register_alumno($id_alumno,$nombres,$primer_apellido,$segundo_apellido,$desplazado,$repitente,$sisben,$full_name_padre,$tel_padre,$full_name_madre,$tel_madre,$fecha_matricula))==true)
    {
       
        if (($user->cambio_alumno_sede($id_alumno,$id_sede))==true) 
        {
           
            if (($user->cambio_alumno_grupo($id_grupo,$id_alumno,$anio_actual['id_anio_lectivo']))==true)
            {
                
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Alumno Matriculado","","success");';
               // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
                echo '}, 1000);</script>';
            }

        }
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Alumno NO Matriculado","","error");';
        echo '}, 1000);</script>';
     }
}

 ?>



    <!-- Top Bar -->
    <?php include("../includes/header.php");?>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php include("../includes/menu.php");?>
    <!-- end menu-->

    <section class="content">
        <div class="container-fluid">

            <!-- Formulario Matricuar Alumno -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Matricula</h2>
                        </div>
                        <div class="body">
                            <form id="register_alumno" method="POST">

                                <h2 class="card-inside-title">Informacion Alumno</h2>

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="id_alumno" required>
                                                <label class="form-label">No. Documento*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombres" id="nombres" required>
                                                <label class="form-label">Nombres*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="primer_apellido" id="primer_pellido" required>
                                                <label class="form-label">Primer Apellido*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="segundo_apellido" id="segundo_pellido" required>
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
                                            <div class="form-line">
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
                                            <div class="form-line">
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
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_grupo" id="getGrupo">
                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="fecha_matricula" class="datepicker form-control" placeholder="Seleccionar Fecha...">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            
                                    
                                    
                                <h2 class="card-inside-title">Informacion Padres de Familia</h2>

                                    <div class="row clearfix">

                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="full_name_padre" class="form-control" required>
                                                    <label class="form-label">Nombre Completo Padre*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="telefono_padre" class="form-control" required>
                                                    <label class="form-label">Telefono*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="full_name_madre" class="form-control" required>
                                                    <label class="form-label">Nombre Completo Madre*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="telefono_madre" class="form-control" required>
                                                    <label class="form-label">Telefono*</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit" name="matricular">Matricular</button>
                                        </div>

                                    </div>
                                    

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Formulario Matricuar Alumno -->     
            

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->

    <!-- Jquery Core Js -->
    
    <script type="text/javascript">
    $(document).ready(function()
    {       
        
    //----------FUNCION SELECCIONAR DOCENTE--------------
        // function to get all records from table
        function getAll(){
            
            $.ajax
            ({
                url: 'getGrupoSede.php',
                data: 'action=showAll',
                cache: false,
                success: function(r)
                {
                    $("#getGrupo").html(r);
                }
            });         
        }
        
        getAll();
        // function to get all records from table
        
        
        // code to get all records from table via select box
        $("#getSede").change(function()
        {               
            var id = $(this).find(":selected").val();

            var dataString = 'action='+ id;
                    
            $.ajax
            ({
                url: 'getGrupoSede.php',
                data: dataString,
                cache: false,
                success: function(r)
                {
                    $("#getGrupo").html(r);
                } 
            });
        })
        // code to get all records from table via select box

    });
    </script>