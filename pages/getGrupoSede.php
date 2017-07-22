<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$grado = new USER();


	
	if($action=="showAll")
	{
		?>
		<option value=""><p class="col-pink">Seleccione Primero Sede</p></option>';
        <?php
	}
	else
	{
		$grado = $grado->Read_grupos_sede($action);
	}
	
	?>
	
	<?php

	if (count($grado) > 0) 
	{                 
        foreach ($grado as $grado)
        {
        	?>
			<option value="<?php echo $grado['id_grupo']; ?>"><?php echo $grado['descripcion_grupo']; ?></option>';
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Grados en la Sede</p></option>';
        <?php
    }
	
	?>
	