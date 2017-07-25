<?php

	include('dbconfig.php');
	include('class.user.php');

	echo "Accion " . $_REQUEST['action'];
	$action = $_REQUEST['action'];

	$periodo = new USER();


	
	if(($action=="showAll") OR ($action==" "))
	{
		?>
		<option value=""><p class="col-pink">Seleccione Primero Año Lectivo</p></option>
        <?php
	}
	else
	{
		$periodo = $periodo->Read_periodos_anio($action);
	}
	
	?>
	
	<?php

	if (count($periodo) > 0) 
	{                 
        foreach ($periodo as $periodo)
        {
        	?>
			<option value="<?php echo $periodo['id_periodo']; ?>"><?php echo $periodo['desc_periodo']; ?></option>
			<?php
        }
    } else {
        ?>
			<option value=""><p class="col-pink">Año lectivo sin Periodos</p></option>
        <?php
    }
	
	?>
	