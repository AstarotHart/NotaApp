<?php

require_once('class.user.php');

$user     = new USER();
$cabecera_print = new USER();
$object   = new USER();

$user_id       = $_REQUEST['variable'];
$id_asignatura = $_REQUEST['id_asignatura'];
$id_grupo      = $_REQUEST['id_grupo'];
$id_tipo       = $_REQUEST['tipo'];

$users = $object->Read_alumnos_grupo($id_grupo);
$cabecera_print = $object->Read_cabecera_grupo($user_id,$id_asignatura,$id_grupo);

/*
echo "Id Docente: ".$user_id."<br>";
echo "Id Asignatura: ".$id_asignatura."<br>";
echo "Id Grupo: ".$id_grupo."<br>";

echo "ALUMNOS<br>";
print_r($users);
*
echo "CABECERA<br>";
print_r($cabecera_print);


/** Incluir la libreria PHPExcel */
require_once '../Classes/PHPExcel/IOFactory.php';
require_once '../Classes/PHPExcel.php';


//cargar plantilla
$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcel->load('plantillas/PlantillaNotas.xlsx'); // Empty Sheet

// Establecer propiedades
$objPHPExcel->getProperties()
                           ->setCreator("NotaApp")
                           ->setLastModifiedBy("NotaApp")
                           ->setTitle("Planilla para Registro de Desempeños")
                           ->setSubject("Planilla para Registro de Desempeños")
                           ->setDescription("Planilla en la cual se podran ingresar las notas de cada alumno y la cual realizara el calculo automatico de la nota final.")
                           ->setKeywords("Excel Office 2007 openxml php")
                           ->setCategory("Planilla de Excel");

//Insertar Datos Cabecera en celdas
if (count($cabecera_print) > 0)
{
   foreach ($cabecera_print as $cabecera_print)
   {
   
   }

   //echo "Nombre Area: ".$cabecera_print['nombre_area']."<br>";

   $objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue("F4", utf8_encode($cabecera_print['nombre_area']))
                           ->setCellValue("M4", utf8_encode($cabecera_print['descripcion_grupo']))
                           ->setCellValue("M5", utf8_encode($cabecera_print['intensidad_horaria']))
                           ->setCellValue("R4", utf8_encode($cabecera_print['id_anio_lectivo']))
                           ->setCellValue("R5", utf8_encode($id_asignatura))
                           ->setCellValue("F5", utf8_encode($cabecera_print['nombre_asignatura']));
                           
}

//Insertar Datos Alumno en celdas
if (count($users) > 0)
{
   $i = 11;
   $fullName = "";
   foreach ($users as $users)
   {
      $fullName = utf8_encode($users['primer_apellido'])." ".utf8_encode($users['segundo_apellido'])." ".utf8_encode($users['nombres']);
      $objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue("C$i", $fullName)
                           ->setCellValue("F$i", $users['id_alumno']);
      $i++;
   }
}

//echo $cabecera['nombre_area'];

$filename = str_replace(' ', '_', (utf8_encode($cabecera_print['nombre_asignatura'])."_".utf8_encode($cabecera_print['descripcion_grupo']).".xlsx"));
// Renombrar Hoja
//$objPHPExcel->getActiveSheet()->setTitle($cabecera_print['descripcion_grupo']);
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
//$objPHPExcel->setActiveSheetIndex(0);

/*

//print_r($objPHPExcel);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename='$filename'");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
*/



//$objWriter->save('pruebaexcel2.xls');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>