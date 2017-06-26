<?php
	include('dbconfig.php');
	include('class.user.php');
	
	$id_sede = $_POST['id_sede'];

	$grupos = new USER();


	if(isset($_POST["sede_id"]) && !empty($_POST["sede_id"]))
	{
	    
	    $id_sede = $_POST['sede_id'];

	    $grupos = $object->Read_grupos_sede($id_sede);
	    
	    if (count($grupos) > 0) 
	    {
	    	echo '<option value="">Seleccionar Sede</option>';

	        foreach ($grupos as $grupo)
	        {
	            echo "<option value='".$grupo['id_grupo']."'>".utf8_encode($grupo['descripcion_grupo'])."</option>"; 
	        }
	    } 
	    else 
	    {
	        echo "<option value=''><p class='col-pink'>Sin Grupos en la Sede</p></option>";
	    }

	}
?>