<!DOCTYPE html>
<html>

<?php 

require_once("class.user.php");
$user = new USER();
$object = new USER();

if(isset($_POST['matricular']))
{
    $id_alumno           = strip_tags($_POST['id_alumno']);
    $id_sede             = strip_tags($_POST['id_sede']);
    $id_grado            = strip_tags($_POST['id_grado']);
    $nombres             = strip_tags($_POST['nombres']);
    $primer_apellido     = strip_tags($_POST['primer_apellido']);
    $segundo_apellido    = strip_tags($_POST['segundo_apellido']);
    $desplazado          = isset($_POST['desplazado']) ? $_POST['desplazado'] : "No" ;
    $repitente           = isset($_POST['repitente']) ? $_POST['repitente'] : "No" ;  
    $nombres_acudiente   = strip_tags($_POST['nombres_acudiente']);
    $apellidos_acudiente = strip_tags($_POST['apellidos_acudiente']);
    $telefono_acudiente  = strip_tags($_POST['telefono_acudiente']);
    $fecha_matricula     = strip_tags($_POST['fecha_matricula']);

    if(($user->register_alumno($id_alumno,$id_sede,$id_grado,$nombres,$primer_apellido,$segundo_apellido,$desplazado,$repitente,$nombres_acudiente,$apellidos_acudiente,$telefono_acudiente,$fecha_matricula))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Alumno Matriculado","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
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

                    <!-- Advanced Form Example With Validation -->
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
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="id_grado" required>
                                                    <option value="">-- Seleccione Grado --</option>
                                                    <?php 
                                                        $user = $object->combobox_grado();
                                                     ?>
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
                            
                                    
                                    
                                <h2 class="card-inside-title">Informacion Acudiente</h2>

                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="nombres_acudiente" class="form-control" required>
                                                    <label class="form-label">Nombre Acudiente*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="apellidos_acudiente" class="form-control" required>
                                                    <label class="form-label">Apellidos*</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="telefono_acudiente" class="form-control" required>
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
            <!-- #END# Advanced Form Example With Validation -->     
            

        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->