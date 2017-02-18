<?php

require_once('class.user.php');

$user     = new USER();
$cabecera = new USER();
$object   = new USER();

$user_id = $_REQUEST['variable'];

$users = $object->Read_alumnos_grupo($user_id);
$cabecera = $object->Read_cabecera_grupo($user_id);


/** Incluir la libreria PHPExcel */
require_once '/../Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
                           ->setCreator("AstarotH")
                           ->setLastModifiedBy("AstarotH")
                           ->setTitle("Planilla para Registro de Desempeños")
                           ->setSubject("Planilla para Registro de Desempeños")
                           ->setDescription("Planilla en la cual se podran ingresar las notas de cada alumno y la cual realizara el calculo automatico de la nota final.")
                           ->setKeywords("Excel Office 2007 openxml php")
                           ->setCategory("Planilla de Excel");

// Agregar Informacion de cabecera
$objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue('A1', 'Nombres')
                           ->setCellValue('B1', 'Codigo');


if (count($users) > 0)
{
   $i = 2;
   foreach ($users as $users)
   {
      $objPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue("A$i", $users['nombres'])
                           ->setCellValue("B$i", $users['id_alumno']);
      $i++;
   }
}



// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Plantilla 7-2');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>