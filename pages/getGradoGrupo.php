<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$grado = new USER();


	
	if($action=="showAll")
	{
		$grado = $grado->Read_grados();
		
	}
	else
	{
		$grado = $grado->Read_grados_sede($action);
	}
	
	?>
	
	<?php

	if (count($grado) > 0) 
	{                 
        foreach ($grado as $grado)
        {
        	?>
			<option value="<?php echo $grado['id_grado']; ?>"><?php echo $grado['descripcion_grado']; ?></option>';
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Grados en la Sede</p></option>';
        <?php
    }
	
	?>
	