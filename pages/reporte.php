<?php 

require_once('../plugins/mpdf/mpdf.php');
include('dbconfig.php');
include('class.user.php');

//echo "Accion " . $_REQUEST['action'];
//$action = $_REQUEST['action'];

$id_alumno       = "8474";
$id_sede         = "IE";
$id_asignatura   = "2017IEIE";
$id_anio_lectivo = "2017IEIE";
$periodo         = "2017IEIEP1";
$grupoo          = "2017IEIE10-1";


echo "ID Alumno ".$id_alumno  ."<br>";
echo "ID Sede ".$id_sede  ."<br>";
echo "ID Asignatura ".$id_asignatura."<br>";
echo "ID periodo ".$periodo."<br>";


$informe_cabecera = new USER();
$informe_asignaturas = new USER();

$informe_cabecera = $informe_cabecera->Read_cabecera_reporte($id_alumno,$id_asignatura,$periodo);

foreach ($informe_cabecera as $informe_cabecera) 
{
	# code...
}

$informe_asignaturas = $informe_asignaturas->Read_asignatura_reporte($id_alumno,$id_anio_lectivo,$grupoo);

foreach ($informe_asignaturas as $informe_asignaturas) 
{
	# code...
}

$anio_str=substr($informe_cabecera['fecha_inicio'], 0,4);
$periodo_str=substr($periodo, -1);
$periodo_str2=substr($periodo, -2);

$str = "2017IEIEM10-C-L1,2017IEIEM10-C-L2,2017IEIEM10-C-L3,";

/*Test Cortar cadena separada por ,*/
print_r(explode(',', $str, -1));

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

echo "ID grupo ".$informe_cabecera['id_grupo']."<br>";
echo "Perdio Str ".$periodo_str."<br>";
echo "Perdio Str 2 ".$periodo_str2."<br><br>";

print_r($informe_cabecera);
print_r($informe_asignaturas);


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
							<span>IE-2017-1-000001</span>
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
						<span>{PAGENO}</span>
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
					<td class="X15">
						<span>'.$informe_cabecera['descripcion_grado'].'</span>
					</td>
					<td class="X15">
						<span>'.$informe_cabecera['descripcion_grupo'].'</span>
					</td>
					<td class="X16">
						<span>4.5</span>
					</td>
					<td class="X16">
						<span>7</span>
					</td>
					<td class="X14 left">
						<span>Diurna</span>
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


$html_asignaturas = '<!-- Start Informe Area-Asignatura -->
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
									<span>4.3</span>
								</td>
								<td class="X20">
									<span>SUPERIOR</span>
								</td>
								<td COLSPAN="2" class="X54 MG10">
									<span>
										<span>'.$informe_asignaturas['nombre_asignatura'].'</span>
									</span>
								</td>
								<td class="X20">
									<span>'.$periodo_show.'</span>
								</td>
								<td class="X20">
									<span>'.$informe_asignaturas['intensidad_horaria'].'</span>
								</td>
								<td class="X20">
									<span>2</span>
								</td>
								<td class="X24">
									<span>SUPERIOR</span>
								</td>
							</tr>
						<!-- End Header Informe Area-Asignatura -->

						<!-- Inicio TexArea logros Asignatura -->
							<tr height="21">
								<td COLSPAN="12" ROWSPAN="8" class="X31 MA11">
									<span>&nbsp;</span>
								</td>
							</tr>

							<tr height="21"></tr>
							<tr height="21"></tr>
							<tr height="21">
								<td class="X11">&nbsp;</td>
							</tr>
							<tr height="21"></tr>
							<tr height="20"></tr>
							<tr height="20">
								<td class="X11">&nbsp;</td>
							</tr>
							<tr height="20">
								<td class="X11">&nbsp;</td>
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
										<span>Acom: 10</span>
									</span>
								</td>
								<td class="X11">&nbsp;</td>
							</tr>
						<!-- Fin Footer Informe Area-Asignatura -->
					<!-- End Informe Area-Asignatura -->';

$html_asignaturas.= '</table>
		  </body>';


/*
$mpdf=new mPDF('c');
$mpdf->mirrorMargins = true;
$mpdf->SetDisplayMode('fullpage','two');
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
$mpdf->Output();
*/
 ?>