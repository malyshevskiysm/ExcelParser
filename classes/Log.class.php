<?php

/*
 * Класс Log предназначен для записи событий в журнал
 * 
 * @author Malyshevskiy Sergey
 */
class Log {   
    const CONFIG_FILE = 'Config.class.php';
    const LOG_FILE_NAME = 'event.log';
    public static $logFile;
    
    /*
     * Метод init считывает путь к каталогу с журналами из файла конфигурации
     */
    public static function init() {
        require_once self::CONFIG_FILE;
        $config = new Config();
        self::$logFile = $config->getParam('log_dir') . self::LOG_FILE_NAME;
    }
    
    /* 
     * Метод addEvent добавляет в файл журнала запись с указанием времени, кода события и его описания.
     * Флаг FILE_APPEND flag нужен для дописывания содержимого в конец файла;
     * Флаг LOCK_EX нужен для предотвращения записи данного файла кем-нибудь другим в данное время    * 
     */
    public static function addEvent($eventNumber, $eventMoreInfo) {
        $dateFormat = "Y-m-d H:i:s";
        $eventLine = date($dateFormat)
                ."\t"
                .$eventNumber
                ."\t"
                .$eventMoreInfo."\n";

        file_put_contents(self::$logFile, $eventLine, FILE_APPEND | LOCK_EX);
        return 1;
    }
}

?>