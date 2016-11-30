<?php

const EXCEL_FILE = './files/list.xls';
const LOG_FILE = './classes/Log.class.php';

require_once LOG_FILE;
Log::init();

if ($_FILES['userfile']['error'] > 0) {
        echo 'Проблема: ';
        switch ($_FILES['userfile']['error']) {
            case 1: Log::addEvent(4, "Ошибка загрузки файла. Размер файла больше upload_max_filesize".$e->getMessage());
                break;
            case 2: Log::addEvent(5, "Ошибка загрузки файла. Размер файла больше max_file_size".$e->getMessage());
                break;
            case 3: Log::addEvent(6, "Ошибка загрузки файла. Загружена только часть файла".$e->getMessage());
                break;
            case 4: Log::addEvent(7, "Ошибка загрузки файла. Файл не загружен".$e->getMessage());
                break;
            case 6: Log::addEvent(8, "Ошибка загрузки файла. Загрузка невозможна: не задан временный каталог".$e->getMessage());
                break;
            case 7: Log::addEvent(9, "Ошибка загрузки файла. Загрузка не выполнена: невозможна запись на диск".$e->getMessage());
                break;
        }
        exit;
    }

if($_FILES['userfile']['size'] > 1024*30*1024)
   {
     echo ("Размер файла превышает тридцать мегабайт");
     exit;
   }
   // Проверка: загружен ли файл?
   if(is_uploaded_file($_FILES['userfile']['tmp_name']))
   {
     // Если файл загружен успешно, он перемещается из временной директории в конечную
     move_uploaded_file($_FILES["userfile"]["tmp_name"], EXCEL_FILE);
     
   } else {
      Log::addEvent(3, "Ошибка загрузки файла. ".$e->getMessage());
   }

