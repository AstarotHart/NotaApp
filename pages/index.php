<!DOCTYPE html>
<html>

    <!-- Top Bar -->
    <?php include("../includes/header.php");?>
    <!-- #Top Bar -->

    <!-- Menu -->
    <?php 
    include("../includes/menu.php");

    $object            = new USER();
    
    // COntar Alumnos por Asignatura
    $num_alumnos       = new USER();
    $num_count         = new USER();
    $cont_alumnos      = 0;
    
    $num_carga_horaria = new USER();
    $cont_IH      = 0;

    //Numero de Asignaturas asignadas a docente
    $num_alumnos = $object->alumnos_a_cargo($user_id);
    $num_asignaturas = count($num_alumnos);



    foreach ($num_alumnos as $num_alumnos)
    {
        $num_count = $object->Read_alumnos_grupo($num_alumnos['id_grupo']);
        $num_carga_horaria = $object->carga_horaria($num_alumnos["id_asignatura"]);

        foreach ($num_count as $num_count)
        {
            $cont_alumnos++;
        }

        foreach ($num_carga_horaria as $num_carga_horaria)
        {
            $cont_IH += $num_carga_horaria['intensidad_horaria'];
        }

    }



    ?>
    <!-- end menu-->

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PANEL DE CONTROL</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix align-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUMNOS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cont_alumnos; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">ASIGNATURAS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $num_asignaturas; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green">
                        <div class="icon">
                            <i class="material-icons">access_time</i>
                        </div>
                        <div class="content">
                            <div class="text">INTENSIDAD HORARIA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cont_IH; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Links In Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALERTAS Y AVISOS
                            </h2>
                        </div>
                        <div class="body">

                            <div class="alert alert-info">
                                <strong>Aviso!</strong> En <strong>15</strong> dias se finalizara el <strong>periodo academico.</strong>
                            </div>

                            <div class="alert alert-warning">
                                <strong>Atención!</strong> En <strong>10</strong> dias se finalizara el <strong>periodo academico.</strong>
                            </div>

                            <div class="alert alert-danger">
                                <strong>Atención!</strong>En <strong>3</strong> dias se finalizara el <strong>periodo academico.</strong>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Links In Alerts -->
                            

            
        </div>
    </section>

    <!-- TFooter -->
    <?php include("../includes/footer.php");?>
    <!-- #Footer -->