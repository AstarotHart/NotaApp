<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$grupos = new USER();

		
		$grupos = $grupos->Read_grupos_sede($action);
		

		if (count($grupos) > 0) 
		{                 
	        foreach ($grupos as $grupo)
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