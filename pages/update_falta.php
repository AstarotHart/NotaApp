<?php
	include('dbconfig.php');
	include('class.user.php');

	$notas = new USER();

	$id_alumno = $_GET['id'];
	$falta      = $_GET['data'];
	$name_falta = $_GET['nota'];
	$materia   = $_GET['materia'];
	$anio      = $_GET['anio'];

	echo "<br>id_alumno: ". $id_alumno;
	echo "<br>Falta: ". $falta;
	echo "<br>name_Falta: ". $name_falta;
	echo "<br>materia: ". $materia;
	echo "<br>anio: ". $anio."<br>";
	
	$notas = $notas->update_faltas($id_alumno,$name_falta,$falta,$materia,$anio);
	echo "ohh YEAH";

?>