<?php

	include('dbconfig.php');
	include('class.user.php');

	//echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$grupo = new USER();


	
	if($action=="showAll")
	{
		$grupo = $grupo->Read_grupos();
		
	}
	else
	{
		$grupo = $grupo->Read_grupos_sede($action);
	}
	
	?>
	
	<?php

	if (count($grupo) > 0) 
	{                 
        foreach ($grupo as $grupo)
        {
        	?>
			<option value="<?php echo $grupo['id_grupo']; ?>"><?php echo $grupo['descripcion_grado']."-".$grupo['descripcion_grupo']; ?></option>';
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Grupos en la Sede</p></option>';
        <?php
    }
	
	?>
	