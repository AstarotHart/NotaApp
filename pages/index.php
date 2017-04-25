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
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"></div>
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
                            <div class="number count-to" data-from="0" data-to="8" data-speed="1000" data-fresh-interval="20"></div>
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
                            <div class="number count-to" data-from="0" data-to="35" data-speed="1000" data-fresh-interval="20"></div>
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