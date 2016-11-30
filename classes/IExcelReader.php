<?php

/*
 * Интерфейс IExcelReader определяет метод для чтения из xls-файла
 */
interface IExcelReader {
    
    /*
     * Метод readFile считывает данные из xls-файла
     */
    public static function readFile($filepath);
    
}