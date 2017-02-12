<?php 

$q = intval($_GET['q']);

    // Design initial table header
    $data = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
            $show_table= "show";
        }
    } 

    //saber si la variable $cabecera['id_asignatura'] fue inicializada
    if (isset($cabecera['id_asignatura']))
    {
        //llamando a la funcion read logros para cargar los losgros por asignatura
        $logros = $object->read_logros($cabecera['id_asignatura']);
        $res_logros = "";
    }
    

    if (count($logros) > 0)
    {
        foreach ($logros as $logros)
        {
            $res_logros .='<li>' . '<b class="font-10">[' .$logros['id_logro']. ']</b> ' . $logros['descripcion']  .'</li>';
        }
    }
    else
    {
        $res_logros = "No hay logros para Mostrar.!!";
    }

    if (count($users) > 0) 
    {
                    
        foreach ($users as $users) 
        {
            if (isset($cabecera['id_asignatura']) and isset($cabecera['id_alumno']))
            {
                $notas  = $object->Read_notas($cabecera['id_asignatura'],$users['id_alumno']);
                $faltas = $object->Read_faltas($cabecera['id_asignatura'],$users['id_alumno']);
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
                        <td><span class="xedit" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="nota1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota1.'</span></td>
                        <td><span tipo="falta" class="xedit" id="periodo1" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p1" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta1.'</span></td>
                        <td><span class="xedit" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="nota2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota2.'</span></td>
                        <td><span class="xedit" id="periodo2" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p2" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta2.'</span></td>
                        <td><span class="xedit" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="nota3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota3.'</span></td>
                        <td><span class="xedit" id="periodo3" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p3" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta3.'</span></td>
                        <td><span class="xedit" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="nota4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_nota4.'</span></td>
                        <td><span class="xedit" id="periodo4" id_alumno="'.$users['id_alumno'].'" name="inasistencia_p4" materia="'.$cabecera['id_asignatura'].'" anio="'.$cabecera['id_anio_lectivo'].'">'.$res_falta4.'</span></td>
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
     
    $data .= '<tbody></table>';

?>
<!-- end menu-->
                        
    <!-- Div mostrar u ocultar tablas -->
    <div  style="display: <?php echo $show_table; ?>;">
        <div class="col-sm-2">
            <b>Grupo:</b> <?php echo $cabecera['descripcion_grupo'] ; ?>
        </div>

        <div class="col-sm-3">
            <b>Asignatura:</b> <?php echo $cabecera['nombre_asignatura']; ?>
        </div>

        <div class="col-sm-2">
            <b>Periodo:</b> 1
        </div>

        <div class="col-sm-2">
            <b>Año Lectivo:</b> <?php echo $cabecera['id_anio_lectivo']; ?>
        </div>

        <div class="col-sm-2">
            <b>Intensidad Horaria:</b> <?php echo $cabecera['intensidad_horaria']; ?>
        </div>

        <div id="miTabla">
            <?php
                
                echo $data; 
                 
            ?>
        </div>
                
            </tbody>
        </table>

        <h5>Logros</h5>
        <blockquote class="m-b-25 font-12">
            
            <ol>
                <?php echo $res_logros;?>
            </ol>
        <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#NewLogro">Nuevo Logro</button>

        </blockquote>

        <blockquote class="blockquote-reverse m-b-25 font-12">
            <p><b>P.1</b>: Primer Periodo,<b>P.2</b>: Segundo Periodo,<b>P.3</b>: Tercer Periodo,<b>P.4</b>: Cuarto Periodo. <b>F. P.1</b>: Faltas Primer Periodo,<b>F. P.2</b>: Faltas Segundo Periodo,<b>F. P.3</b>: Faltas Tercer Periodo,<b>F. P.4</b>: Faltas Cuarto Periodo. </p>
        </blockquote>

        <button id="enable" class="btn btn-default">enable / disable</button>

    </div><!-- Fin DIV ocultar o mostrar tabla -->