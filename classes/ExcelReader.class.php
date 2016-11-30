<?php
require_once 'IExcelReader.php';

/*
 * Класс ExcelReader предназначен для считывания данных из файла .xls
 * 
 * @author Malyshevskiy Sergey
 */
class ExcelReader implements IExcelReader{
    const PHPEXCEL_LIB_PATH = './lib/PHPExcel.php';

    /*
     * Метод readFile считывает данные из файла $filepath и возвращает массив данных
     */
    public static function readFile($filepath){
        //Подключение фреймворка PHPExcel
        require_once self::PHPEXCEL_LIB_PATH; 

        $ar=array();        
        if (isset($filepath)) { 
                $inputFileType = PHPExcel_IOFactory::identify($filepath);  // Определение типа файла
                $objReader = PHPExcel_IOFactory::createReader($inputFileType); // Создание объекта для чтения файла
                $objPHPExcel = $objReader->load($filepath); // Загрузка данных файла в объект
                $ar = $objPHPExcel->getActiveSheet()->toArray(); // Выгрузка данных из объекта в массив
        }

        return $ar;
    }
    
}
?>

