<?php
	include('dbconfig.php');
	include('class.user.php');

	$notas = new USER();

	if($_GET['id'] and $_GET['data'])
	{
		$id_alumno = $_GET['id'];
		$nota      = $_GET['data'];
		$name_nota = $_GET['nota'];
		$materia   = $_GET['materia'];
		$anio      = $_GET['anio'];

		echo "<br>id_alumno: ". $id_alumno;
		echo "<br>nota: ". $nota;
		echo "<br>name_nota: ". $name_nota;
		echo "<br>materia: ". $materia;
		echo "<br>anio: ". $anio ."<br>";
		
		$notas = $notas->update_nota($id_alumno,$name_nota,$nota,$materia,$anio);
		echo $notas;
	}
?>