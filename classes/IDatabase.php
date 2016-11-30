<?php

/*
 * Интерфейс IDatabase определяет основные методы для добавления, очистки и печати таблицы
 */
interface IDatabase {
    
    /*
     * Метод setRow добавляет запись в таблицу
     */
    public function setRow($array);
    
    /*
     * Метод printRows выводит таблицу и сортирует в соответствии с параметрами
     */
    public function printRows($orderField, $order);
    
    /*
     * Метод clearTable очищает таблицу
     */
    public function clearTable();
}

