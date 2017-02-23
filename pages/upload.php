<?php
  include('dbconfig.php');
  include('class.user.php');

  $notas = new USER();
  $faltas = new USER();

  if(isset($_POST['submit_image']))
  {
    $id_user       = $_GET['id_user'];
    $id_asignatura = $_GET['id_asignatura'];
    $anio_lectivo  = $_GET['anio_lectivo'];
    $name_nota     = $_GET['name_nota'];
    $name_falta    = $_GET['name_falta'];
/*
    echo "<br>id_user: ". $id_user;
    echo "<br>id_alumno: ". $id_alumno;
    echo "<br>name_nota: ". $name_nota;
    echo "<br>id_asignatura: ". $id_asignatura;
    echo "<br>anio_lectivo: ". $anio_lectivo ."<br>";
*/
    $uploadfile=$_FILES["upload_file"]["tmp_name"];

    if (isset($uploadfile))
    {

      $folder="Subidas/".$id_user;

      if (!is_dir($folder))
      {
        mkdir($folder, 0777, true);
        $folder .= "/";
      }
      else
      {
        $folder .= "/";
      }


      move_uploaded_file($_FILES["upload_file"]["tmp_name"], $folder.$_FILES["upload_file"]["name"]);
      //echo 'archivo <b>'."".$_FILES["upload_file"]["name"].'</b> subido con exito';
      echo '<div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                archivo <b>'."".$_FILES["upload_file"]["name"].'</b> subido con exito.
                            </div>';

      require_once '/../Classes/PHPExcel/IOFactory.php';

      $fullURL = $folder.$_FILES["upload_file"]["name"];

      //Cargo la hoja de cálculo
      $objPHPExcel = PHPExcel_IOFactory::load($fullURL);

      //Asigno la hoja de calculo activa
      $objPHPExcel->setActiveSheetIndex(0);

      //Numero mazimo de filas
      $numRows = 56;

      //Creacion de Array con la informacion de las notas
      for ($i = 11; $i <= $numRows; $i++)
      {
    
        $informacion[] = array(
                                'id_alumno' => $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue(),
                                'nota' => $objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue(),
                                'faltas' => $objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue(),  
                              );

      }

      foreach($informacion as $item)
      {

          if ($item['id_alumno'] != NULL)
          {
              //llamado a la funcion UPDATE_NOTA para ingresar notas
              $notas->update_nota($item['id_alumno'],$name_nota,$item['nota'],$id_asignatura,$anio_lectivo);

              //llamado a la funcion UPDATE_FALTAS para ingresar FALTAS
              $faltas->update_faltas($item['id_alumno'],$name_falta,$item['faltas'],$id_asignatura,$anio_lectivo);
          }
          
      }    

    }
  }

?>