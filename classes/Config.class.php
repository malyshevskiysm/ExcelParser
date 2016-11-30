<?php

/*
 * Класс Config предназначен для считывания данных из конфигурационного файла
 * 
 * @author Malyshevskiy Sergey
 */
class Config {
    
    private $config;
    private $log_dir;
    private $db_driver;
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_password;
    
    /*
     * Конструктор выполняет загрузку данных из файла конфигурации
     */
    public function __construct() {
        $this->load();
    }
    
    /*
     * Метод load считывает данные из конфигурационного файла и заносит в 
     * поле config
     */
    private function load() {
        $config = parse_ini_file("config.ini");
        
        //Параметры логирования
        $this->log_dir = $config["log_dir"];

        //Параметры базы данных
        $this->db_driver = $config["db_driver"];
        $this->db_host = $config["db_host"];
        $this->db_name = $config["db_name"];
        $this->db_user = $config["db_user"];
        $this->db_password = $config["db_password"];
    }
    
    /*
     * Метод getParam возвращает значение из конфигурационного файла по его имени
     */
    public function getParam($param) {
        if (isset($this->$param)) {
            return $this->$param;
        } else {
            return 0;
        }
        
    }
}

?>