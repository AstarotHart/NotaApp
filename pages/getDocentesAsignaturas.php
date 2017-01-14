<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$docentes = new USER();


	
	if($action=="showAll")
	{
		$docentes = $docentes->Read_docente();
		
	}
	else
	{
		$docentes = $docentes->Read_docente_sede($action);;
	}
	
	?>
	<!--<option value="">-- Seleccione Docente --</option>-->
	<?php

	if (count($docentes) > 0) 
	{                 
        foreach ($docentes as $docente)
        {
        	?>
			<option value="<?php echo $docente['id_docente']; ?>"><?php echo $docente['nombres'].' '.$docente['prim_apellido']; ?></option>'; 
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Docente en la Sede</p></option>';
        <?php
    }
	
	?>
	