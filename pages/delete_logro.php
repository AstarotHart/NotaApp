<?php
    
    header('Content-type: application/json; charset=UTF-8');
    
    $response = array();
    
    if ($_POST['id_logro']) {
        
        include('dbconfig.php');
        include('class.user.php');

        $del_logro = new USER();
        
        $id_logro = $_POST['id_logro'];

        $del_logro->Delete_logro($id_logro);

        if ($del_logro == true) {
            $response['status']  = 'success';
            $response['message'] = 'Logro Borrado...';
        } else {
            $response['status']  = 'error';
            $response['message'] = 'No se puede eliminar el Logro ...';
        }
        echo json_encode($response);
    }

?>