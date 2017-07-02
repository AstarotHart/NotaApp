<?php
    
    header('Content-type: application/json; charset=UTF-8');
    
    $response = array();
    
    if ($_POST['id_logro']) {
        
        include('dbconfig.php');
        include('class.user.php');

        $del_logro = new USER();
        
        $id_logro = $_POST['id_logro'];

        $accion ="Eliminar";
        $id_assignatura ="";
        $descripcion = "";

        $del_logro->update_logro($id_logro,$id_assignatura,$descripcion,$accion);

        if ($del_logro == true) {
            $response['status']  = 'success';
            $response['message'] = 'Observacion Borrada...';
        } else {
            $response['status']  = 'error';
            $response['message'] = 'No se puede eliminar la Observacion ...';
        }
        echo json_encode($response);
    }

?>