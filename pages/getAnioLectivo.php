<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$anios_lectivos = new USER();


	
	if($action=="showAll")
	{
		$anios_lectivos = $anios_lectivos->Read_anio_lectivo();
		
	}
	else
	{
		$anios_lectivos = $anios_lectivos->Read_anio_lectivo_sede($action);
	}
	
	?>
	<!--<option value="">-- Seleccione Area --</option>-->
	<?php

	if (count($anios_lectivos) > 0) 
	{                 
        foreach ($anios_lectivos as $anio_lectivo)
        {
        	?>
			<option value="<?php echo $anio_lectivo['id_anio_lectivo']; ?>"><?php echo $anio_lectivo['descripcion_anio_lectivo']; ?></option>'; 
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Años lectivos en la Sede</p></option>';
        <?php
    }

	?>
	