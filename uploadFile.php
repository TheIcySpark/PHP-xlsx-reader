<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\listWorksheetInfo;

function isFileOk(){
    try{
        if(!isset($_FILES['file'])){
            throw new Exception("Seleccione un archivo");
        }
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $allowedExtensions = array('xlsx', 'xls');
        if(!in_array($extension, $allowedExtensions)){
            throw new Exception("Tipo de extension no permitida");
        }else if($_FILES['file']['error'] != UPLOAD_ERR_OK){
            throw new Exception("Error al subir el archivo");
        }
    }catch(Exception $e){
        echo $e->getMessage(), "\n";
        return false;
    }
    return true;
}

function getSpreadSheedForRead($name){
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($_FILES[$name]['tmp_name']);;
    return $spreadsheet;    
}

function echoSheet($sheetName){
    $spreadsheet = getSpreadSheedForRead('file');
    
    $sheet = $spreadsheet->setActiveSheetIndexByName($sheetName);
    $sheet = $spreadsheet->getActiveSheet();
    echo '<table class="table table-bordered">';
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
}

function echoSheets(){
    $sheetNames = getSpreadSheedForRead('file')->getSheetNames();
    foreach($sheetNames as $sheetName){
        echo "<h1>", $sheetName, "</h1>";
        echoSheet($sheetName);
    }
}



if (isFileOk()){
    echoSheets();
}
