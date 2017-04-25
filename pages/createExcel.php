<?php

require_once('class.user.php');

$user     = new USER();
$cabecera = new USER();
$object   = new USER();

$user_id = $_REQUEST['variable'];
$id_asignatura = $_REQUEST['id_asignatura'];

$users = $object->Read_alumnos_grupo($user_id,$id_asignatura);
$cabecera = $object->Read_cabecera_grupo($user_id,$id_asignatura);


/** Incluir la libreria PHPExcel */
require_once '/../Classes/PHPExcel/IOFactory.php';
require_once '/../Classes/PHPExcel.php';

//cargar plantilla
$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcel->load('plantillas/PlantillaNotas.xlsx'); // Empty Sheet

// Establecer propiedades
$objPHPExcel->getProperties()
                           ->setCreator("AstarotH")
                           ->setLastModifiedBy("AstarotH")
                           ->setTitle("Planilla para Registro de Desempeños")
                           ->setSubject("Planilla para Registro de Desempeños")
                           ->setDescription("Planilla en la cual se podran ingresar las notas de cada alumno y la cual realizara el calculo automatico de la nota final.")
                           ->setKeywords("Excel Office 2007 openxml php")
                           ->setCategory("Planilla de Excel");

//Insertar Datos Cabecera en celdas
if (count($cabecera) > 0)
{
   foreach ($cabecera as $cabecera)
   {
   
   }

   $fullgrupo = $cabecera['descripcion_grado']."-".$cabecera['descripcion_grupo'];

   $objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue("F4", $cabecera['nombre_area'])
                           ->setCellValue("M4", $fullgrupo)
                           ->setCellValue("M5", $cabecera['intensidad_horaria'])
                           ->setCellValue("R4", $cabecera['id_anio_lectivo'])
                           ->setCellValue("F5", $cabecera['nombre_asignatura']);

}

//Insertar Datos Alumno en celdas
if (count($users) > 0)
{
   $i = 11;
   $fullName = "";
   foreach ($users as $users)
   {
      $fullName = $users['primer_apellido']." ".$users['segundo_apellido']." ".$users['nombres'];
      $objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue("C$i", $fullName)
                           ->setCellValue("F$i", $users['id_alumno']);
      $i++;
   }
}

$filename = $cabecera['nombre_asignatura'].$fullgrupo.".xlsx";

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle($fullgrupo);

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
<<<<<<< HEAD
header("Content-Disposition: attachment;filename='$filename'");
=======
header('Content-Disposition: attachment;filename="Plantilla.xlsx"');
>>>>>>> origin/Laptop
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>