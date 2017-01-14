<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$areas = new USER();


	
	if($action=="showAll")
	{
		$areas = $areas->Read_areas();
		
	}
	else
	{
		$areas = $areas->Read_areas_sede($action);
		//$stmt=$this->conn->prepare('SELECT id_docente, nombres, prim_apellido FROM docente WHERE id_sede=:cid');
		//$stmt->execute(array(':cid'=>$action));
	}
	
	?>
	<!--<option value="">-- Seleccione Area --</option>-->
	<?php

	if (count($areas) > 0) 
	{                 
        foreach ($areas as $area)
        {
        	?>
			<option value="<?php echo $area['id_area']; ?>"><?php echo $area['nombre_area']; ?></option>'; 
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Sin Areas en la Sede</p></option>';
        <?php
    }

	?>
	