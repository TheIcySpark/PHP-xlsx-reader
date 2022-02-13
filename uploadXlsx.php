<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\listWorksheetInfo;

$file = $_FILES['file'];
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$allowedExtensions = array('xlsx', 'xls');
$message = "";
if(in_array($extension, $allowedExtensions)){
    if($file['error'] == UPLOAD_ERR_OK){

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);;
        $writer = IOFactory::createWriter($spreadsheet, 'Html');
        
        echo '<table class="table table-bordered">';
        $sheet = $spreadsheet->getActiveSheet();
        foreach($sheet->getRowIterator() as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            echo '<tr>';
            foreach($cellIterator as $cell){
                $value = $cell->getCalculatedValue();
                echo '<td>'.$value.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

    }else{
        $message = "Error al subir el archivo";
    }
}else{
    $message = "Tipo de archivo no admitido";
}

echo $message;