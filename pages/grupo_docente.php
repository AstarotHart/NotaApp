<script>
    function upload_image() 
    {
        var bar = $('#bar');
        var percent = $('#percent');
        
        $('#myForm').ajaxForm({
            beforeSubmit: function() {
                document.getElementById("progress_div").style.display="block";
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                if(xhr.responseText)
                {
                    document.getElementById("output_image").innerHTML=xhr.responseText;
                }
            }
        }); 
    }
</script> 


<style>
    #myForm 
    { 
    width:400px;
    margin-top:50px;
    margin: auto; 
    background: #A9BCF5; 
    border-radius: 10px; 
    padding: 15px 
    }

    .progress {text-align:left;margin-top:20px;display:none; position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
    .bar { background-color:#2E64FE; width:0%; height:30px; border-radius: 3px; }
    .percent { position:absolute; display:inline-block; top:8px; left:48%; }
</style>

<?php 
require_once("class.user.php");

$user           = new USER();
$cabecera       = new USER();
$logros_alumnos = new USER();
$nota           = new USER();
$falta          = new USER();
$logros         = new USER();
$newLogro       = new USER();
$object         = new USER();
$fechas         = new USER();
$asig_id        = new USER();


$show_table_alumnos = "none";
$show_table_logros  = "none";
$res_logros_alumno  = " ";

//saber si el boton CREAR de logro a sifo inicializado
if (isset($_POST['crear'])) 
{
    $id_asignatura=$_POST['id_asignatura'];
    $logro=$_POST['logro'];
    
     //Llamada a funcion para crear nuevo LOGRO
     
    if(($newLogro->register_logros($id_asignatura,$logro))==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro Creado.","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro NO Creado.","","error");';
        echo '}, 1000);</script>';
     }
}

//saber si el boton CREAR de logro a sifo inicializado
if (isset($_POST['asignar_logros'])) 
{
    $id_logros=$_POST['select_logros'];
    $id_alumnos=$_POST['select_alumnos'];
    $id_asig = $_POST['id_asignatura'];
    $id_anio_lec= $_POST['id_anio_lectivo'];
    
    $logros_insert = "";

    foreach ($id_logros as $id_logros) 
    {
       $logros_insert .= $id_logros.", "; 
    }

    $logros_insert .=".";

    foreach ($id_alumnos as $id_alumnos)
    {
        echo "Id_ASI: ".$id_asig."<br>";
        echo "Id_AL: ".$id_alumnos."<br>";
        echo "Id_ANIO: ".$id_anio_lec."<br>";
        echo "Id_LOGROS: ".$logros_insert."<br>";

        $logros_alumnos->register_logros_alumno($id_asig,$id_alumnos,$id_anio_lec,$logros_insert);
    }
    
     
    if($logros_alumnos==true)
    {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro Creado.","","success");';
       // echo 'setTimeout(function () {swal({title: "Datos Actualizados",text: "",timer: 2000,showConfirmButton: false});';
        echo '}, 1000);</script>';
     }
     else
     {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Logro NO Creado.","","error");';
        echo '}, 1000);</script>';
     }
     
}


 ?>

<!-- Top Bar -->
<?php include("../includes/header.php");?>
<!-- #Top Bar -->

<!-- Menu -->
<?php 
    include("../includes/menu.php");

    //saber si el boton CREAR de logro a sifo inicializado
    if (isset($_POST['btn-select-GR'])) 
    {
        $_SESSION['id_asignatura']=$_POST['id_asignatura'];    
    }

    if (isset($_SESSION['id_asignatura']))
    {
        $id_asignatura = $_SESSION['id_asignatura'];
    }


if (isset($id_asignatura))
{
    $cabecera = $object->Read_cabecera_grupo($user_id,$id_asignatura);
    
    $num = 1;

    $data_select = "";
    // Design initial table header
    $data = '<table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nombre Estudiente</th>
                                <th>Codigo</th>
                                <th>P. 1</th>
                                <th>F. P1</th>
                                <th>P. 2</th>
                                <th>F. P2</th>
                                <th>P. 3</th>
                                <th>F. P3</th>
                                <th>P. 4</th>
                                <th>F. P4</th>
                                <th>NOTA FINAL</th>
                                <th>FALTAS TOTALES</th>
                                <th>Acciones</th>
                            </tr>
                        <thead>
                        <tbody>
                        ';
    // Cargar datos en un array con CABECERA
    if (count($cabecera) > 0) 
    {
                    
        foreach ($cabecera as $cabecera) 
        {
            $show_table_alumnos= "show";
        }
    }

    //saber si la variable $cabecera['id_asignatura'] fue inicializada
    if (isset($cabecera['id_asignatura']))
    {
        $users = $object->Read_alumnos_grupo($user_id,$id_asignatura);

        //llamando a la funcion read logros para cargar los losgros por asignatura
        $logros      = $object->read_logros($cabecera['id_asignatura']);
        $fechas      = $object->Read_fecha_periodos($cabecera['id_anio_lectivo']);
        $list_logros = "<ol>";
        $res_logros  = " ";
    }

    echo "Numero de ALumnos ".count($users);

    // cargar Informacion Periodos
    if (count($fechas) > 0)
    { 
        $fechas_periodos=array();
        $cont_fechas=0;
        foreach ($fechas as $fechas)
        {
            $fechas_periodos[$cont_fechas]=$fechas;
            $cont_fechas++;
        }

        if (count($fechas_periodos) > 0) 
        {
            //Name Nota Upload Excel
            $name_nota = "";

            //# periodos
            $no_periodo1 = 1;
            $no_periodo2 = 2;
            $no_periodo3 = 3;
            $no_periodo4 = 4;

            //ids Peridos
            $id_periodo1 = ((array_column($fechas_periodos, "id_periodo"))[0]);
            $id_periodo2 = ((array_column($fechas_periodos, "id_periodo"))[1]);
            $id_periodo3 = ((array_column($fechas_periodos, "id_periodo"))[2]);
            $id_periodo4 = ((array_column($fechas_periodos, "id_periodo"))[3]);

            //Fecha InicioPeridos
            $inicio_periodo1 = ((array_column($fechas_periodos, "fecha_inicio"))[0]);
            $inicio_periodo2 = ((array_column($fechas_periodos, "fecha_inicio"))[1]);
            $inicio_periodo3 = ((array_column($fechas_periodos, "fecha_inicio"))[2]);
            $inicio_periodo4 = ((array_column($fechas_periodos, "fecha_inicio"))[3]);

            //Fecha FinPeridos
            $fin_periodo1 = ((array_column($fechas_periodos, "fecha_fin"))[0]);
            $fin_periodo2 = ((array_column($fechas_periodos, "fecha_fin"))[1]);
            $fin_periodo3 = ((array_column($fechas_periodos, "fecha_fin"))[2]);
            $fin_periodo4 = ((array_column($fechas_periodos, "fecha_fin"))[3]);

            //Fecha InicioPeridos
            $desc_periodo1 = ((array_column($fechas_periodos, "desc_periodo"))[0]);
            $desc_periodo2 = ((array_column($fechas_periodos, "desc_periodo"))[1]);
            $desc_periodo3 = ((array_column($fechas_periodos, "desc_periodo"))[2]);
            $desc_periodo4 = ((array_column($fechas_periodos, "desc_periodo"))[3]);

            $editar_tablas_p1="none";
            $editar_tablas_p2="none";
            $editar_tablas_p3="none";
            $editar_tablas_p4="none";

            date_default_timezone_set('America/Bogota');

            $fechaHoy = date('Y-m-d');
            //$fechaHoy = "2017-03-18";

            //comparar fecha primer periodo
            if ($fechaHoy > $inicio_periodo1 AND $fechaHoy < $fin_periodo1) 
            {
                $editar_tablas_p1 = "xedit";
                $name_nota = "nota1";
                $name_falta = "inasistencia_p1";
            }
            elseif ($fechaHoy > $inicio_periodo2 AND $fechaHoy < $fin_periodo2) 
            {
                $editar_tablas_p2 = "xedit";
                $name_nota = "nota2";
                $name_falta = "inasistencia_p2";
            }
            elseif ($fechaHoy > $inicio_periodo3 AND $fechaHoy < $fin_periodo3) 
            {
                $editar_tablas_p3 = "xedit";
                $name_nota = "nota3";
                $name_falta = "inasistencia_p3";
            }
            elseif ($fechaHoy > $inicio_periodo4 AND $fechaHoy < $fin_periodo4) 
            {
                $editar_tablas_p4 = "xedit";
                $name_nota = "nota4";
                $name_falta = "inasistencia_p4";
            }
        }
    }

    // Saber si logros ha sido inicializado
    if (count($logros) > 0)
    {
        $i=1;
        foreach ($logros as $logros)
        {
            $list_logros .='<li>' . '<b class="font-10">[' .$logros['id_logro']. ']</b> ' . $logros['descripcion']  .'</li>';

            $res_logros .='<option value="' .$logros['id_logro']. '">' .$logros['id_logro']. '</option>';

            $i++;
        }

        // Saber si res_logros ha sido inicializado
        if (isset($List_logros)) 
        {
            $list_logros .= "</ol>";
        }
        
    }
    else
    {
        $res_logros = "No hay logros para Mostrar.";
    }

    // Sber si USERS esta vacio
    if (count($users) > 0) 
    {
                    
        foreach ($users as $users) 
        {
            $notas  = $object->Read_notas($cabecera['id_asignatura'],$users['id_alumno']);
            $faltas = $object->Read_faltas($cabecera['id_asignatura'],$users['id_alumno']);

            if (isset($cabecera['id_asignatura']) and isset($cabecera['id_alumno']))
            {
                $show_table_alumnos = "show";
            }
                $res_nota1      = "0";
                $res_nota2      = "0";
                $res_nota3      = "0";
                $res_nota4      = "0";
                $nota_final     = 0;
                $res_nota_final = "0";
                
                $res_falta1      = "0";
                $res_falta2      = "0";
                $res_falta3      = "0";
                $res_falta4      = "0";
                $falta_final     = "0";
                $res_falta_final = "0";

            if (isset($notas) and count($notas) > 0) 
            {
                foreach ($notas as $notas) 
                {
                    $res_nota1  = $notas['nota1'];
                    $res_nota2  = $notas['nota2'];
                    $res_nota3  = $notas['nota3'];
                    $res_nota4  = $notas['nota4'];
                    $nota_final = ($res_nota1+$res_nota2+$res_nota3+$res_nota4)/4;
                    $nota_final =  number_format($nota_final,1);  
                }
                if ($nota_final <= 2.9) 
                {
                    $res_nota_final = '<p class="font-bold col-pink">'.$nota_final.'</p>';
                }
                else
                {
                    $res_nota_final = '<b>'.$nota_final.'</b>';
                }
                
            }

            if (isset($faltas) and count($faltas) > 0) 
            {
                foreach ($faltas as $faltas) 
                {
                    $res_falta1  = $faltas['inasistencia_p1'];
                    $res_falta2  = $faltas['inasistencia_p2'];
                    $res_falta3  = $faltas['inasistencia_p3'];
                    $res_falta4  = $faltas['inasistencia_p4'];
                    $falta_final = ($res_falta1+$res_falta2+$res_falta3+$res_falta4);    
                }
                if ($falta_final >= "4") 
                {
                    $res_falta_final = '<p class="font-bold col-pink">'.$falta_final.'</p>';
                }
                else
                {
                    $res_falta_final = $falta_final;
                }
                
            }

            // Saber si $id_asignatura & $cabecera['id_alumno'] han sido inicializados
            if (isset($id_asignatura) and isset($users['id_alumno']))
            {                
                $logros_alumnos = $object->Read_logros_alumno($id_asignatura,$users['id_alumno']);                
            }

            /** Saber si $logros_alunos han sido inicializados y hay registros encontrados**/
            if (isset($logros_alumnos) and count($logros_alumnos) > 0)
            {
                foreach ($logros_alumnos as $logros_alumnos)
                {
                    $res_logros_alumno = $logros_alumnos['id_logros']. '<br>';
                }
            }
            else
            {
                $res_logros_alumno = "No hay logros.";
            }

            //saber si se han iniciado las variables de alumno
            if (isset($users['primer_apellido']) and isset($users['segundo_apellido']) and isset($users['nombres']) and isset($users['id_alumno']) and isset($cabecera['id_asignatura']) and isset($cabecera['id_anio_lectivo']))
            {
                $data .= '
                    <tr>
                        <td>' . $num. '</td>
                        <td>' . $users['primer_apellido'] . ' ' .$users['segundo_apellido'] . ' ' .$users['nombres'] .'</td>
                        <td>' . $users['id_alumno'] . '</td>
                        <td><span class="'.$editar_tablas_p1.'" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="nota1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota1.'</span></td>
                        <td><span tipo="falta" class="'.$editar_tablas_p1.'" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta1.'</span></td>
                        <td><span class="'.$editar_tablas_p2.'" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="nota2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota2.'</span></td>
                        <td><span class="'.$editar_tablas_p2.'" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta2.'</span></td>
                        <td><span class="'.$editar_tablas_p3.'" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="nota3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota3.'</span></td>
                        <td><span class="'.$editar_tablas_p3.'" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta3.'</span></td>
                        <td><span class="'.$editar_tablas_p4.'" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="nota4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota4.'</span></td>
                        <td><span class="'.$editar_tablas_p4.'" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta4.'</span></td>
                        <td>' . $res_nota_final . '</td>
                        <td>' . $res_falta_final . '</td>
                        <td>
                            '.$res_logros_alumno.'                             
                        </td>
                    </tr>';
                $num++;

                $data_select .= '<option value="' . $users['id_alumno'] . '">' . $users['primer_apellido'] . ' ' .$users['segundo_apellido'] . ' ' .$users['nombres'] .'</option>';
            }
            
        }
    }
    else 
    {
        // records not found
        $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
    }
     
    $data .= '<tbody></table>';
}

?>
<!-- end menu-->

<section class="content">
    <div class="container-fluid">

        <!-- Lista de Docentes -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="padding-bottom: 10px;"">
                        <h2>
                            Asignaturas <small>Lista de Estudientes Por Asignaturas</small>
                        </h2>
                        
                        <!-- form para seleccionar GRUPO por ASIGNATURA -->
                        <form style="margin-bottom: 2px;" method="POST">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group" style="margin-bottom: 2px;">
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="id_asignatura">
                                                    <option value="">-- Seleccione Grupo --</option>
                                                    <?php 
                                                        $user = $object->combobox_grupos_docente($user_id);
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button class="btn bg-teal waves-effect" type="submit" name="btn-select-GR">Aceptar</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="body" >
                        <?php   
                        if (isset($id_asignatura))
                        { ?>   
                        <div class="col-sm-2">
                            <b>Grupo:</b> <?php if (isset($cabecera['descripcion_grupo'])) 
                            {
                                echo $cabecera['descripcion_grado']."-".$cabecera['descripcion_grupo'];
                            }else{echo " ";} ?>
                        </div>

                        <div class="col-sm-3">
                            <b>Asignatura:</b> <?php if (isset($cabecera['nombre_asignatura'])) 
                            {
                                 echo $cabecera['nombre_asignatura'];
                            }else{echo " ";} ?>
                        </div>

                        <div class="col-sm-2">
                            <b>Periodo:</b> <?php if (isset($id_periodo1)) 
                            {
                                 echo $id_periodo1;
                            }else{echo " ";} ?>
                        </div>

                        <div class="col-sm-2">
                            <b>Año Lectivo:</b> <?php if (isset($cabecera['id_anio_lectivo'])) 
                            {
                                 echo $cabecera['id_anio_lectivo'];
                            }else{echo " ";} ?>
                        </div>

                        <div class="col-sm-2">
                            <b>Intensidad Horaria:</b> <?php if (isset($cabecera['intensidad_horaria'])) 
                            {
                                 echo $cabecera['intensidad_horaria'];
                            }else{echo " ";} ?>
                        </div>
                        <br><br>
                    

            <!-- Div mostrar u ocultar tablas -->
                <div  style="display: <?php echo $show_table_alumnos; ?>;">

                    <div class="card">
                        <div class="body" style="padding-top: 10px;">
                        
                        <!-- Boton para cargar collpse de LOGOS -->
                            <div class='col-sm-12'>
                                <button class="btn bg-cyan waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Logros</button>

                                <button type='button' class='btn bg-teal waves-effect' data-toggle='modal' data-target='#NewLogro'>Nuevo Logro</button>
                            </div>

                            <!--Boton crear Nuevo Logro-->
                            

                            <div class="collapse" id="collapseExample">
                                <!-- Mostrar Logros en un Quote-->
                                <h5>Logros</h5>
                                <blockquote class="font-12">
                                    <?php
                                        
                                        if (isset($list_logros)) 
                                        {
                                            echo $list_logros;
                                        } 
                                    ?>
                                </blockquote>

                                <!-- SlectBox Logros -->
                                <form id="check_logros" method="POST">

                                <!-- enviar de manera oculta datos id_asignatura e id_anio_lectivo --> 
                                    <input type="hidden" class="form-control" name="id_asignatura" value="<?php echo $cabecera['id_asignatura']; ?>">
                                    <input type="hidden" class="form-control" name="id_anio_lectivo" value="<?php echo $cabecera['id_anio_lectivo']; ?>">

                                    <div class="demo-checkbox">
                                        <select name="select_logros[]" size="3" multiple="multiple" tabindex="1">
                                    <?php
                                        
                                        if (isset($res_logros)) 
                                        {
                                            echo $res_logros;
                                        } 
                                    ?>
                                        </select>
                                    </div>

                                    <br>

                                <!-- Multi Select Alumnos para LOGROS-->
                                    
                                    <select id="optgroup" name="select_alumnos[]" class="ms" multiple="multiple">
                                    <?php
                                        echo $data_select;
                                     ?>
                                    </select>

                                    <div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
                                        <button type="button" class="btn bg-blue waves-effect" id="select-all">Todos</button>
                                        <button type="button" class="btn bg-red waves-effect" id="deselect-all">Ninguno</button>
                                    </div>
                                    
                                    <div class='col-sm-12 align-right'>
                                        <button class="btn bg-green waves-effect" type="submit" name="asignar_logros">Aceptar</button>
                                    </div>

                                </form>                            
                            </div>

                        </div>
                    </div>
                </div><!-- Fin div SHOW-->

                <div class="card" >
                    <div class="body" >

                        <div id="miTabla">
                                <?php echo $data; ?>
                                </tbody>
                            </table>
                        </div>
                                
                        <blockquote class="blockquote-reverse m-b-25 font-12">
                            <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
                        </blockquote>

                        <!-- Collapse Upload File -->
                        <div class="collapse" id="UploadFile" role="Upload_file">
                            <button type="button" class="close" data-toggle="collapse" data-target="#UploadFile" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="well">
                                <form action="upload.php?id_asignatura=<?php echo $cabecera['id_asignatura']; ?>&anio_lectivo=<?php echo $cabecera['id_anio_lectivo']; ?>&name_nota=<?php echo $name_nota; ?>&name_falta=<?php echo $name_falta; ?>&id_user=<?php echo $user_id; ?>" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
                                  <input type="file" id="upload_file" name="upload_file" />
                                  <input type="submit" name='submit_image' value="Subir" onclick='upload_image();'/>
                                </form>
                                <div class='progress' id="progress_div">
                                    <div class='bar' id='bar1'></div>
                                    <div class='percent' id='percent1'>0%</div>
                                </div>
                                <div id='output_image'></div>
                            </div>
                        </div> 
                        

                        <div class='col-sx-12'>    
                            <a href="createExcel.php?variable=<?php echo $user_id; ?>&id_asignatura=<?php echo $id_asignatura;?> " class="btn bg-teal waves-effect" role="button">Descargar Plantilla</a>
                        
                            <!-- subir archivos -->
                            <button class="btn bg-teal waves-effect" type="button" data-toggle="collapse" data-target="#UploadFile" aria-expanded="false" aria-controls="UploadFile">
                                Subir Archivo
                            </button>
                        </div>
                        
                    </div>
                </div>

                </div>
                </div>

            </div>
        </div>
        <!-- #END# Lista Docentes -->
<?php } ?>
    </div>
</section>

<!-- TFooter -->
<?php include("../includes/footer.php");?>
<!-- #Footer -->

<script src="../js/bootstrap-editable.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Jquery Form -->
<script src="../plugins/jquery.form.min.js"></script>

<!-- Funcion para editar FALTAS alumno-->
<script type="text/javascript">
    jQuery(document).ready(function() {  
            $.fn.editable.defaults.mode = 'popup';
            $('.xedit').editable();     
            $(document).on('click','.editable-submit',function(){
                var u = $(this).closest('td').children('span').attr('anio');
                var v = $(this).closest('td').children('span').attr('materia');
                var w = $(this).closest('td').children('span').attr('name');
                var x = $(this).closest('td').children('span').attr('id_alumno');
                var y = $('.materia').val();
                var z = $(this).closest('td').children('span');
                if (w == "inasistencia_p1" || w == "inasistencia_p2" || w == "inasistencia_p3" || w == "inasistencia_p4" ) 
                {
                    $.ajax({
                        url: "update_falta.php?id="+x+"&data="+y+"&nota="+w+"&materia="+v+"&anio="+u,
                        type: 'GET',
                        success: function(s){
                            location.reload();
                            if(s == 'status'){
                            $(z).html(y);}
                            if(s == 'error') {
                            alert('Error Processing your Request!');}
                        },
                        error: function(e){
                            alert('Error Processing your Request!!');
                        }
                    });
                }
                else
                {
                    $.ajax({
                        url: "update_nota.php?id="+x+"&data="+y+"&nota="+w+"&materia="+v+"&anio="+u,
                        type: 'GET',
                        success: function(s){
                            location.reload();
                            if(s == 'status'){
                            $(z).html(y);}
                            if(s == 'error') {
                            alert('Error Processing your Request!');}
                        },
                        error: function(e){
                            alert('Error Processing your Request!!');
                        }
                    })
                }
                
            });
    });
</script>

<script type="text/javascript">
    $(function(){
        //enable / disable
       $('#enable').click(function() {
           $('#miTabla #periodo1').editable('toggleDisabled');
       });
    });

    $("[data-toggle=popover]").popover({
    html: true, 
    content: function() {
          return $('#popover-content').html();
        }
});
</script>





<!-- Modal crear nuevo LOGRO -->
    <div class="modal fade" id="NewLogro" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="Actu_DatosLabel">Crear Nuevo Logro</h4>
                </div>
                <div class="modal-body">
                    <form id="Area_new" method="POST">

                        <input type="hidden" class="form-control" name="id_asignatura" value="<?php echo $cabecera['id_asignatura']; ?>">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">assignment</i>
                            </span>
                            <div class="form-line">
                                <textarea name="logro" cols="30" rows="6" class="form-control no-resize" maxlength="150" required autofocus></textarea>
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