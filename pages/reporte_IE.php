<!-- <link href="plantillas/style_informe.css" rel="stylesheet"> -->
<?php 
ini_set('memory_limit', '512M');
require_once('../plugins/mpdf/mpdf.php');
include('dbconfig.php');
include('class.user.php');

$informe_cabecera    = new USER();
$informe_asignaturas = new USER();
$nota_acomulada_asig = new USER();
$faltas_asignatura   = new USER();
$asignaturas_grupo   = new USER();
$object              = new USER();
$desc_logro          = new USER();
$logros_alumno       = new USER();
$desc_observacion    = new USER();
$observacion_alumno  = new USER();

$html_asignaturas    = "";
$logros_print        = "";
$observaciones_print = "";
$desempe ;
$faltas_print ;




/**
 *  NOTAS FINALES ASIGNATURA
 */

/**
	$notas  = new USER();
	$nota_final_reg = new USER();

	$id_anio_lectivo = "IE2017";


	$notas  = $object->Read_notas_sede($id_anio_lectivo);

	$res_nota1      = "0";
	$res_nota2      = "0";
	$res_nota3      = "0";
	$res_nota4      = "0";
	$nota_final     = 0;
	$res_nota_final = "0";

	$porcentaje_periodo1 = 20;
	$porcentaje_periodo2 = 20;
	$porcentaje_periodo3 = 35;
	$porcentaje_periodo4 = 25;


	if (isset($notas) and count($notas) > 0) 
	{
	    foreach ($notas as $notas) 
	    {	
	        $res_nota1  = $notas['nota1'];
	        $res_nota2  = $notas['nota2'];
	        $res_nota3  = $notas['nota3'];
	        $res_nota4  = $notas['nota4'];
	        $nota_final = (($res_nota1*$porcentaje_periodo1)+($res_nota2*$porcentaje_periodo2)+($res_nota3*$porcentaje_periodo3)+($res_nota4*$porcentaje_periodo4)) ;

	        $nota_final = $nota_final/(100);

	        $nota_final =  number_format($nota_final,1);

	        //echo "Nota Final: ". $nota_final."<br>";

	        $nota_final_reg = $object->update_nota_final($notas['id_alumno'],$notas['id_asignatura'],$id_anio_lectivo,$nota_final); 
	    }
	    
	}


	print_r($notas);

**/












//echo "Accion " . $_REQUEST['action'];
//$action = $_REQUEST['action'];

$id_alumno       = "1088256153";
$id_sede         = "IE";
//$id_asignatura   = "CieNatYEEdu-6-CN";
$id_anio_lectivo = "IE2017";
$periodo         = "IE2017P1";
$grupo           = "IE6-1";
$id_informe      = "";


$id_informe = $periodo.'-'.$id_alumno;

/*
echo "ID Alumno: ".$id_alumno  ."<br>";
echo "ID Sede: ".$id_sede  ."<br>";
echo "ID Asignatura: ".$id_asignatura."<br>";
echo "ID periodo: ".$periodo."<br>";
*/

$informe_cabecera = $object->Read_cabecera_reporte($id_alumno,$id_anio_lectivo);

foreach ($informe_cabecera as $informe_cabecera) 
{
	# code...
}

$anio_str=substr($informe_cabecera['fecha_inicio_periodo'], 0,4);
$periodo_str=substr($periodo, -1);
$periodo_str2=substr($periodo, -2);

$str_grupo=substr($informe_cabecera['descripcion_grupo'], -1);
$str_grado=substr($informe_cabecera['descripcion_grupo'], -4, -2);


switch ($periodo_str) {
	case '1':
		$nota_show  = "nota1";
		$falta_show = "inasistencia_p1";
		break;

	case '2':
		$nota_show  = "nota2";
		$falta_show = "inasistencia_p2";
		break;

	case '3':
		$nota_show  = "nota3";
		$falta_show = "inasistencia_p3";
		break;

	case '4':
		$nota_show  = "nota4";
		$falta_show = "inasistencia_p4";
		break;
	
}


//echo "Informe Cabecera<br>";
//print_r($informe_cabecera);


$asignaturas_grupo = $object->Read_asignaturas_grupo($grupo);

//$notaaaa = 4;


$desc_observacion = $object->Read_observaciones_periodo($id_alumno,$id_anio_lectivo);

//print_r($desc_observacion);


// Recorrer y leer logros de alumno
foreach ($desc_observacion as $desc_observacion)
{
	$observacion_alumno = $object->Read_observaciones_reporte($desc_observacion['id_observacion']);

	//print_r($observacion_alumno);

	foreach ($observacion_alumno as $observacion_alumno)
	{
		$observaciones_print  = $observacion_alumno['descripcion']."<br>";
	}

  	if ($observaciones_print !="")
	{

	}
	else
	{
		$observaciones_print = "No hay Observaciones para este Periodo.";
	}
}

//WORKS
//print_r($logros_alumno);

// WORKS
//print_r($nota_acomulada_asig);

//echo "<br>Desc Logros<br>";
//print_r($desc_logro);

//WORKS
//echo "Algo?<br>";
//echo $observaciones_print;


foreach ($asignaturas_grupo as $asignaturas_grupo)
{
	//echo "Id asignatura: ".$asignaturas_grupo['id_asignatura']."<br>";

	
	$informe_asignaturas = $object->Read_asignatura_reporte($id_alumno,$id_anio_lectivo,$asignaturas_grupo['id_asignatura']);
	$nota_acomulada_asig = $object->Read_nota_definitiva($id_alumno,$id_anio_lectivo,$asignaturas_grupo['id_asignatura']);
	$faltas_asignatura   = $object->Read_faltas_reporte($id_alumno,$id_anio_lectivo,$asignaturas_grupo['id_asignatura']);


	$desc_logro = $object->Read_logros_asignatura_periodo($id_alumno,$id_anio_lectivo,$asignaturas_grupo['id_asignatura'],$periodo);

	
	//print_r($desc_logro);
	
	

	foreach ($nota_acomulada_asig as $nota_acomulada_asig)
	{
	
	}

	foreach ($faltas_asignatura as $faltas_asignatura)
	{
		$faltas_print = $faltas_asignatura[$falta_show];
	}

	// WORKS
	//print_r($nota_acomulada_asig);

	// WORKS
	//print_r($faltas_asignatura);
	
// Recorrer y leer logros de alumno
	foreach ($desc_logro as $desc_logro)
	{

		$logros_alumno = explode( ',', $desc_logro['id_logros'] );

      	foreach ($logros_alumno as $logros_alumno)
      	{
      		//echo "Logros: ".$logros_alumno."<br>";
      		$desc_logro = $object->Read_logro_tr($logros_alumno);

      		foreach ($desc_logro as $desc_logro)
	      	{
	      		$logros_print  .= $desc_logro['descripcion']."<br>";
	      	}
      	}

	}

	//WORKS
	//print_r($logros_alumno);

	// WORKS
	//print_r($nota_acomulada_asig);
	
	//echo "<br>Desc Logros<br>";
	//print_r($desc_logro);
	
	//WORKS
	//echo $logros_print;


		foreach ($informe_asignaturas as $informe_asignaturas) 
		{
			// convertir la nota de string a numero
			$nota_num = number_format($informe_asignaturas[$nota_show],1);


			//hacer comparaciones de la nota con los valores establesidos
			if (($nota_num>0) AND ($nota_num<=2.9))
			{
				$desempe = "Bajo";

			}
			elseif (($nota_num>=3) AND ($nota_num<=3.9))
			{
				$desempe = "Básico";

			}
			elseif (($nota_num>=4) AND ($nota_num<=4.5))
			{
				$desempe = "Alto";

			}
			elseif (($nota_num>=4.6) AND ($nota_num<=5))
			{
				$desempe = "Superior";

			}

			//saber de la variable LOGRO_PRINT esta inicializado con ""
			if ($logros_print !="")
			{

			}
			else
			{
				$logros_print = "No hay logros para mostrar.";
			}


			//saber de la variable LOGRO_PRINT esta inicializado con ""
			if ($faltas_print !="")
			{

			}
			else
			{
				$faltas_print = 0;
			}


			$html_asignaturas .= '<!-- Start Informe Area-Asignatura -->
							<!-- Start Header Informe Area-Asignatura -->
								<tr height="20">
									<td COLSPAN="4" class="X37 MA9">
										<span>
											<span>Area</span>
										</span>
									</td>
									<td class="X21 left">
										<span>Nota Area</span>
									</td>
									<td class="X21 left">
										<span>Desempeño</span>
									</td>
									<td COLSPAN="2" class="X37 MG9">
										<span>
											<span>Asigatura</span>
										</span>
									</td>
									<td class="X21 left">
										<span>Nota</span>
									</td>
									<td class="X21 left">
										<span>IH</span>
									</td>
									<td class="X21 left">
										<span>Faltas</span>
									</td>
									<td class="X22 left">
										<span>Desempeño</span>
									</td>
								</tr>

								<tr height="21">
									<td COLSPAN="4" class="X54 MA10">
										<span>
											<span>'.$informe_asignaturas['nombre_area'].'</span>
										</span>
									</td>
									<td class="X20">
										<span>4.3 NO</span>
									</td>
									<td class="X20">
										<span>SUPERIOR NO</span>
									</td>
									<td COLSPAN="2" class="X54 MG10">
										<span>
											<span>'.$informe_asignaturas['nombre_asignatura'].'</span>
										</span>
									</td>
									<td class="X20">
										<span>'.$informe_asignaturas[$nota_show].'</span>
									</td>
									<td class="X20">
										<span>'.$informe_asignaturas['intensidad_horaria'].'</span>
									</td>
									<td class="X20">
										<span>'.$faltas_print.'</span>
									</td>
									<td class="X24">
										<span>'.$desempe.'</span>
									</td>
								</tr>
							<!-- End Header Informe Area-Asignatura -->

							<!-- Inicio TexArea logros Asignatura -->
								<tr height="21">
									<td COLSPAN="12" ROWSPAN="auto" class="X31 MA11">
										'.$logros_print.'
									</td>
								</tr>
															
							<!-- Fin TexArea logros Asignatura -->

							<!-- Inicio Footer Informe Area-Asignatura -->
								<tr height="21">
									<td COLSPAN="2" class="X29 MA19">
										<span>
											<span>Nota Periodos Anteriores</span>
										</span>
									</td>
									<td COLSPAN="3" class="X30 MC19">
										<span>
											<span>P1:  '.$informe_asignaturas['nota1'].'</span>
										</span>
									</td>
									<td COLSPAN="1" class="X30 ME19">
										<span>
											<span>P2:  '.$informe_asignaturas['nota2'].'</span>
										</span>
									</td>
									<td COLSPAN="2" class="X30 MG19">
										<span>
											<span>P3:   '.$informe_asignaturas['nota3'].'</span>
										</span>
									</td>
									<td COLSPAN="2" class="X30 MI19">
										<span>
											<span>P4:   '.$informe_asignaturas['nota4'].'</span>
										</span>
									</td>
									<td COLSPAN="2" class="X53 MK19">
										<span>
											<span>Acom: '.$nota_acomulada_asig['nota_definitiva_asig'].'</span>
										</span>
									</td>
									<td class="X11">&nbsp;</td>
								</tr>
							<!-- Fin Footer Informe Area-Asignatura -->
						<!-- End Informe Area-Asignatura -->
						
						<!-- Inicio Epacio -->
					<tr height="7">
						<td class="X17">&nbsp;</td>
						<td COLSPAN="6" class="X41 MB8">
							<span>&nbsp;</span>
						</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td width="8" class="X18">&nbsp;</td>
					</tr>
					<!-- Fin Epacio -->
					
						';
		
		}
	$logros_print = '';
	$faltas_print = 0;

	

}

/*
$html_asignaturas .= '<!-- Start Informe Area-Asignatura -->
							<!-- Start Header Informe Area-Asignatura -->
								<tr height="20">
									<td COLSPAN="12" class="X37 MA9 X54 MA10" style="border-right:1px solid black;">
										<span>
											<span>Observaciones</span>
										</span>
									</td>
								</tr>

								<tr height="21">
									<td COLSPAN="12" class="X54 MA10" style="border-right:1px solid black;">
										<span>
											
										</span>
									</td>
								</tr>
							<!-- End Header Informe Area-Asignatura -->

							<!-- Inicio TexArea logros Asignatura -->
								<tr height="21">
									<td COLSPAN="12" ROWSPAN="auto" class="X31 MA11">
										<span>Observaciones 7</span>
									</td>
								</tr>
															
							<!-- Fin TexArea logros Asignatura -->

							<!-- Inicio Footer Informe Area-Asignatura -->
								<tr height="21">
									
									<td COLSPAN="12" class="X37 MB6">							
										<span> &nbsp;</span>									
										
									</td>

									<td class="X11">&nbsp;</td>

								</tr>
								

								<tr height="21">
									
									<td COLSPAN="6" class="X39 MB7" style="border-right:none; text-align: center;">
										<span>
											<span>&nbsp;</span><br>
											<span>Director(a) Grupo</span>
										</span>
									</td>

									<td COLSPAN="6" class="X39 MB7" style="border-left: inset 0pt; text-align: center;">
										<span>
											<span>_______________________________</span><br>
											<span>'.$informe_cabecera['primer_apellido'].' '.$informe_cabecera['segundo_apellido'].' '.$informe_cabecera['nombres'].'</span>
										</span>
									</td>
																		
									<td class="X11">&nbsp;</td>
								</tr>

							<!-- Fin Footer Informe Area-Asignatura -->
						<!-- End Informe Area-Asignatura -->
						
						<!-- Inicio Epacio -->
					<tr height="7">
						<td class="X17">&nbsp;</td>
						<td COLSPAN="6" class="X41 MB8">
							<span>&nbsp;</span>
						</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td width="8" class="X18">&nbsp;</td>
					</tr>
					<!-- Fin Epacio -->

					</table>
		  </body>
					
						';
*/




$html_asignaturas .= '<!-- Start Informe Area-Asignatura -->
							<!-- Start Header Informe Area-Asignatura -->
								<tr height="20">
									<td COLSPAN="12" class="X377 MA9" >
										<span>
											<span>Observaciones</span>
										</span>
									</td>
								</tr>

								<tr height="21">
									<td COLSPAN="12" class="X544 MC10">
										<span>
											<span>&nbsp;</span>
										</span>
									</td>
									
								</tr>
							<!-- End Header Informe Area-Asignatura -->

							<!-- Inicio TexArea logros Asignatura -->
								<tr height="21">
									<td COLSPAN="12" ROWSPAN="auto" class="X31 MA11">
										'.$observaciones_print.'
									</td>
								</tr>
															
							<!-- Fin TexArea logros Asignatura -->

							<!-- Inicio Footer Informe Area-Asignatura -->
								<tr height="21">
									<td COLSPAN="6" class="X300 MI19">
										<span>
											<span>Director(a) de Grupo</span>
										</span>
									</td>
									
									<td COLSPAN="6" class="X301 MI19">
										<span>
											<span>&nbsp;</span><br>
											<span>&nbsp;</span><br>
											<span>&nbsp;</span><br>
											<span>&nbsp;</span><br>
											<span>_______________________________</span><br>
											<span>'.$informe_cabecera['primer_apellido'].' '.$informe_cabecera['segundo_apellido'].' '.$informe_cabecera['nombres'].'</span>
											<span>&nbsp;</span><br>
										</span>
									</td>
									<td class="X11">&nbsp;</td>
								</tr>
							<!-- Fin Footer Informe Area-Asignatura -->
						<!-- End Informe Area-Asignatura -->
						
						<!-- Inicio Epacio -->
					<tr height="7">
						<td class="X17">&nbsp;</td>
						<td COLSPAN="6" class="X41 MB8">
							<span>&nbsp;</span>
						</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td class="X13">&nbsp;</td>
						<td width="8" class="X18">&nbsp;</td>
					</tr>
					<!-- Fin Epacio -->
					
						';







$html_asignaturas.= '</table>
		  </body>';

/*
echo "<br>Informe Asignaturas<br>";
print_r($informe_asignaturas);
*/

/*Test Cortar cadena separada por ,*/
//print_r(explode(',', $str, -1));


switch ($periodo_str2) {
	case 'P1':
		$periodo_show = $informe_asignaturas['nota1'];
		break;

	case 'P2':
		$periodo_show = $informe_asignaturas['nota2'];
		break;

	case 'P3':
		$periodo_show = $informe_asignaturas['nota3'];
		break;

	case 'P4':
		$periodo_show = $informe_asignaturas['nota4'];
		break;
	
	default:
		$periodo_show = "Sin Nota Periodo.";
		break;
}

/*
echo "<br>ID grupo ".$informe_cabecera['descripcion_grupo']."<br>";
echo "Perdio Str: ".$periodo_str."<br>";
echo "Perdio Str 2: ".$periodo_str2."<br><br>";

echo "Grupo Str: ".$str_grupo."<br>";
echo "Grado Str 2: ".$str_grado."<br><br>";



echo "<br>Informe Asignatura<br>";
print_r($informe_asignaturas);

*/


$html_cabecera = '<body>
		    <table cellspacing="0">

		<!-- Start Header INFORME -->
				<tr height="25">
					<td width="123" ROWSPAN="4" class="X42 MA1">
						<span>
							<img style="height:82px;width:82px" src="../images/Escudo.jpg" alt="Image" />
						</span>
						<span>&nbsp;</span>
					</td>
					<td COLSPAN="9" ROWSPAN="2" class="X45 MB1">
						<span>
							<span>INSTITUCIÓN EDUCATIVA INSTITUTO ESTRADA</span>
							<p style = "font-size: 8pt">Reconocida por Resoluciones 2625 de Dic. 13 de 2002  y 1041 de Nov 19 de 2010 de la Sec. De Educación Dptal.
							Carrera 8ª No. 18-53  Tels. 3685132-3686087, Marsella, Risaralda.
							Código Dane 166440000067.  Nit.  891.412.146-8</p>
							
						</span>
					</td>
					<td COLSPAN="2" class="X55 MK1">
						<span>
							<span>Codigo Informe</span>
						</span>
					</td>
				</tr>
				<tr height="20">
					<td COLSPAN="2" class="X57 MK2">
						<span>
							<span>'.$id_informe.'</span>
						</span>
					</td>
				</tr>
				<tr height="20">
					<td COLSPAN="9" ROWSPAN="2" class="X45 MB3">
						<span>
							<span>INFORME PERIODICO DE EVALUACION</span>
						</span>
					</td>
					<td width="76" class="X25 left">
						<span>Version</span>
					</td>
					<td width="111" class="X26">
						<span>1.0</span>
					</td>
				</tr>
				<tr height="20">
					<td class="X28 left">
						<span>Pagina</span>
					</td>
					<td class="X27">
						<span>{PAGENO} de {nbpg}</span>
					</td>
				</tr>

				<!-- Inicio Epacio -->
				<tr height="4">
					<td class="X9">&nbsp;</td>
					<td width="158" class="X8">&nbsp;</td>
					<td width="11" class="X8">&nbsp;</td>
					<td width="32" class="X8">&nbsp;</td>
					<td width="71" class="X5">&nbsp;</td>
					<td width="109" class="X8">&nbsp;</td>
					<td width="96" class="X8">&nbsp;</td>
					<td width="54" class="X8">&nbsp;</td>
					<td width="68" class="X8">&nbsp;</td>
					<td width="67" class="X8">&nbsp;</td>
					<td class="X8">&nbsp;</td>
					<td class="X8">&nbsp;</td>
				</tr>
				<!-- End Espacio -->

				<tr height="20">
					<td class="X12 left">
						<span>Año: '.$anio_str.'</span>
					</td>
					<td COLSPAN="4" class="X37 MB6">
						<span>
							<span>Nombre Estudiante</span>
						</span>
					</td>
					<td COLSPAN="2" class="X37 MF6">
						<span>
							<span>Codigo</span>
						</span>
					</td>
					<td class="X23 left">
						<span>Grado</span>
					</td>
					<td class="X23 left">
						<span>Grupo</span>
					</td>
					<td class="X23 left">
						<span>Promedio</span>
					</td>
					<td class="X23 left">
						<span>Puesto</span>
					</td>
					<td class="X23 left">
						<span>Jornada</span>
					</td>
				</tr>
				<tr height="21">
					<td class="X12 left">
						<span>Periodo: '.$periodo_str.'</span>
					</td>
					<td COLSPAN="4" class="X39 MB7">
						<span>
							<span>'.$informe_cabecera['primer_apellido'].' '.$informe_cabecera['segundo_apellido'].' '.$informe_cabecera['nombres'].'</span>
						</span>
					</td>
					<td COLSPAN="2" class="X39 MF7">
						<span>
							<span>'.$id_alumno.'</span>
						</span>
					</td>
					<td class="X15 center">
						<span>'.$str_grado.'</span>
					</td>
					<td class="X15 center">
						<span>'.$str_grupo.'</span>
					</td>
					<td class="X16 center">
						<span>4.5 NO</span>
					</td>
					<td class="X16 center">
						<span>7 NO</span>
					</td>
					<td class="X14 center">
						<span>'.$informe_cabecera['descripcion_jornada'].'</span>
					</td>
				</tr>
		<!-- End Header INFORME -->

				<!-- Inicio Epacio -->
				<tr height="7">
					<td class="X17">&nbsp;</td>
					<td COLSPAN="6" class="X41 MB8">
						<span>&nbsp;</span>
					</td>
					<td class="X13">&nbsp;</td>
					<td class="X13">&nbsp;</td>
					<td class="X13">&nbsp;</td>
					<td class="X13">&nbsp;</td>
					<td class="X13">&nbsp;</td>
					<td width="8" class="X18">&nbsp;</td>
				</tr>
				<!-- Fin Epacio -->

		    ';





//echo $html_cabecera;
//echo $html_asignaturas;



$mpdf=new mPDF('', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8);
$mpdf->SetDisplayMode('fullwidth');
$mpdf->SetHTMLFooter('

					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-style: italic;">
						<tr>

							<td width="33%"><span style="font-style: italic;font-size: 6.5pt;">NotaApp 1.0<br>soportenotaapp@gmail.com</span></td>

							<td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO} de {nbpg}</td>

							<td width="33%" style="text-align: right; "></td>

						</tr>
					</table>

					');

$css = file_get_contents('plantillas/style_informe.css'); //if you wanted some styling
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html_cabecera);
$mpdf->WriteHTML($html_asignaturas);


$folder="Informes/".$id_sede."/".$id_anio_lectivo."/".$grupo;

      if (!is_dir($folder))
      {
        mkdir($folder, 0777, true);
        $folder .= "/";
      }
      else
      {
        $folder .= "/";
      }

//$mpdf->Output(''.$folder.'informe_'.$id_informe.'.pdf','F');
$mpdf->Output();   
exit;

?>