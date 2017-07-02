<?php
    
    header('Content-type: application/json; charset=UTF-8');
    
    $response = array();
    
    if ($_POST['id_observacion']) {
        
        include('dbconfig.php');
        include('class.user.php');

        $del_observacion = new USER();
        
        $id_observacion = $_POST['id_observacion'];

        $accion ="Eliminar";
        $id_grupo ="";
        $descripcion = "";

        $del_observacion->update_observacion($id_observacion,$id_grupo,$descripcion,$accion);

        if ($del_observacion == true) {
            $response['status']  = 'success';
            $response['message'] = 'Observacion Borrado...';
        } else {
            $response['status']  = 'error';
            $response['message'] = 'No se puede eliminar el Observacion ...';
        }
        echo json_encode($response);
    }

?>