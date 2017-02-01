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
		
		$notas = $notas->update_nota($id_alumno,$name_nota,$nota,$materia);
		echo "ohh YEAH";
	}

	echo "FUCK";
?>