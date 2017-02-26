<?php
  include('dbconfig.php');
  include('class.user.php');

  $cabecera = new USER();
  $users    = new USER();
  $object   = new USER();

  $data = "No hay datos para mostrar! fuck yeah!";

    $user_id       = $_POST['id_docente'];
    $id_asignatura = $_POST['id_asignatura'];

    $cabecera = $object->Read_cabecera_grupo($user_id,$id_asignatura);
    $users    = $object->Read_alumnos_grupo($user_id,$id_asignatura);


    $num = 1;


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
        //llamando a la funcion read logros para cargar los losgros por asignatura
        $logros = $object->read_logros($cabecera['id_asignatura']);
        $fechas = $object->Read_fecha_periodos($cabecera['id_anio_lectivo']);
        $res_logros = "<ol>";
    }

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


    $data = '<div class="col-sm-2">
                <b>Grupo:</b>'.$cabecera['descripcion_grado']."-".$cabecera['descripcion_grupo'].'
            </div>

            <div class="col-sm-3">
                <b>Asignatura:</b>'.$cabecera['nombre_asignatura'].'
            </div>

            <div class="col-sm-2">
                <b>Periodo:</b>'.$id_periodo1.'
            </div>

            <div class="col-sm-2">
                <b>Año Lectivo:</b>'.$cabecera['id_anio_lectivo'].'
            </div>

            <div class="col-sm-2">
                <b>Intensidad Horaria:</b> '.$cabecera['intensidad_horaria'].'
            </div>

            <!-- Boton para cargar collpse de LOGOS -->

                    <button class="btn bg-cyan waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                        Logros
                    </button>
                <div class="collapse" id="collapseExample">
                    <div class="well">
                    <!-- Mostrar Logros en un Quote-->
                        <blockquote class="m-b-25 font-12">
                            <h5>Logros</h5>

                            <form id="Area_new" method="POST">

                              '.$res_logros.'
                            <br>
                                <div class="col-sm-3">

                                    <input type="checkbox" id="md_checkbox_26" class="filled-in chk-col-blue" checked />
                                    <label for="md_checkbox_26">Seleccionar Para Todos.</label>

                                    <button class="btn bg-green waves-effect" type="submit" name="crear_">Aceptar</button>
                                </div>

                            </form>
                            <!--Boton crear Nuevo Logro-->
                            <div class="col-sm-12 align-center">
                                <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#NewLogro">Nuevo Logro</button>
                            </div><br><br><br><br>
                            
                        </blockquote>
                    </div>
                </div>
    
                <table class="table font-13 table-bordered table-striped table-hover js-basic-example dataTable">
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

    
    if (count($logros) > 0)
    {
        foreach ($logros as $logros)
        {
            $res_logros .='<input type="checkbox" id="basic_checkbox_1" value="' .$logros['id_logro']. '" />
                                <label for="basic_checkbox_1 style="
    margin-bottom: auto;"><li><b class="font-10">[' .$logros['id_logro']. ']</b> ' . $logros['descripcion']  .'</li></label><br>';
        }

        if (isset($res_logros)) 
        {
            $res_logros .= "</ol>";
        }
        
    }
    else
    {
        $res_logros = "No hay logros para Mostrar.!!";
    }
    if (count($users) > 0) 
    {
      echo "ENcontro registros en USERS<br>";
                    
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
            if (isset($cabecera['id_asignatura']) and isset($cabecera['id_alumno']))
            {
                //llamando a la funcion read logros para cargar los losgros por asignatura
                $logros_alumnos = $object->Read_logros_alumno($cabecera['id_asignatura'],$users['id_alumno']);
                $res_logros_alumno = "";
            }
            
            if (isset($logros_alumnos) and count($logros_alumnos) > 0)
            {
                foreach ($logros_alumnos as $logros_alumnos)
                {
                    $res_logros_alumno =$logros_alumnos['id_logros']. '<br>';
                }
            }
            else
            {
                $res_logros_alumno = "No hay logros para Mostrar.!!";
            }
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
                            
                            <select class="form-control show-tick" multiple name="id_logros">
                                        <option value="">-- Seleccione Logros --</option> 
                                            '. $user = $object->combobox_logros($cabecera['id_asignatura']) .'
                                    </select>                             

                        </td>
                    </tr>';
                $num++;
            }
            
        }
    } 
    else 
    {
        // records not found
        $data .= '<tr><td colspan="6">No hay registros para mostrar!</td></tr>';
    }
     
    $data .= '</tbody>
                            </table>
                            
                            <blockquote class="blockquote-reverse m-b-25 font-12">
                                <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
                            </blockquote>

                        </div><!-- Fin DIV ocultar o mostrar tabla -->
   

                        <!-- Collapse Upload File -->
                        <div class="collapse" id="UploadFile" role="Upload_file">
                            <button type="button" class="close" data-toggle="collapse" data-target="#UploadFile" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="well">
                                <form action="upload.php?id_asignatura='.$cabecera['id_asignatura'].'&anio_lectivo='.$cabecera['id_anio_lectivo'].'&name_nota='.$name_nota.'&name_falta='.$name_falta.'&id_user='.$user_id.'" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
                                  <input type="file" id="upload_file" name="upload_file" />
                                  <input type="submit" name="submit_image" value="Subir" onclick="upload_image();"/>
                                </form>
                                <div class="progress" id="progress_div">
                                    <div class="bar" id="bar1"></div>
                                    <div class="percent" id="percent1">0%</div>
                                </div>
                                <div id="output_image"></div>
                            </div>
                        </div> 
                        

                        <div class="col-sx-12">    
                            <a href="createExcel.php?variable=<?php echo $user_id; ?> " class="btn bg-teal waves-effect" role="button">Descargar Plantilla</a>
                        
                            <!-- subir archivos -->
                            <button class="btn bg-teal waves-effect" type="button" data-toggle="collapse" data-target="#UploadFile" aria-expanded="false" aria-controls="UploadFile">
                                Subir Archivo
                            </button>

                        </div>';

    $data .='<!-- Modal crear nuevo LOGRO -->
              <div class="modal fade" id="NewLogro" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="Actu_DatosLabel">Crear Nuevo Logro</h4>
                          </div>
                          <div class="modal-body">
                              <form id="Area_new" method="POST">

                                  <input type="hidden" class="form-control" name="id_asignatura" value="'.$cabecera['id_asignatura'].'">
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
              </div>';


  echo $data;

?>