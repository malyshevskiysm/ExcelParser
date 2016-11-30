<?php
require_once 'IDatabase.php';
require_once 'Log.class.php';

/*
 * Класс Database предназначен для считывания и записи данных в базу данных
 * 
 * @author Malyshevskiy Sergey
 */
class Database implements IDatabase{
    const CONFIG_FILE = 'Config.class.php';
    const LOG_FILE = './classes/Log.class.php';
    const CLASS_ORGANIZATION_FILE = 'Organization.class.php';
    
    private static $dsn;
    private static $driver;
    private static $host;
    private static $name;
    private static $user;
    private static $password;
    private $pdo;
    
    /*
     * Конструктор создает объект PDO для соединения с базой данных
     */
    public function __construct() {
        require_once self::CONFIG_FILE;
        
        $config = new Config();
        Log::init();

        $this->driver = $config->getParam('db_driver');
        $this->host = $config->getParam('db_host');
        $this->name = $config->getParam('db_name');
        $this->user = $config->getParam('db_user');
        $this->password = $config->getParam('db_password');
        
        $this->dsn = "mysql:host=$this->host;dbname=$this->name";
        
        unset($config);
        
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        } 
        catch (PDOException $e) {
            require_once self::LOG_FILE;
            
            Log::addEvent(1, "Не удалось подключиться к базе данных. ".$e->getMessage());           
        }
    }  
    
    /*
     * Метод checkData преобразует входящую строку для устранения опасности иньекций
     */
    private function checkData($str){ 
        $str = htmlspecialchars($str); 
        $str = stripslashes($str); 
        return $str;
    }
    
    /*
     * Метод checkDataArray преобразует строки в массиве в безопасные
     */
    private function checkDataArray($array){
        foreach ($array as $key => $value){
            $array[$key] = $this->checkData($value);
        }
        return $array;
    }
    
    /*
     * Метод setRow добавляет массив строк как запись в базу данный
     */
    public function setRow($array){
        require_once self::CLASS_ORGANIZATION_FILE;
        try {
            $errorCode = 999;

            //Проверка входных данных           
            $array = $this->checkDataArray($array);
            $organization = $array['organization'];
            $address = $array['address'];
            $phone = $array['phone'];
            
            
            //Создание и выполнение sql-запроса
            $sql = 'INSERT INTO organizations (organization, address, phone) '
                 . 'VALUES(:organization, :address, :phone)';
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':organization', $organization, PDO::PARAM_STR);
            $stm->bindParam(':address', $address, PDO::PARAM_STR);
            $stm->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stm->execute();
            
            //Запись ошибки в журнал
            require_once self::LOG_FILE;
            $log = new Log();
            $log->addEvent(2, "Строка ".$array["Login"]." успешно добавлена");
            unset($log);
            return 1;
        }  catch (Exception $e){
            //Запись ошибки в журнал
            require_once self::LOG_FILE;
            $log = new Log();
            $log->addEvent($errorCode, 'Ошибка добавления строки '.$array["Login"].$e->getMessage());
            unset($log);
            return $errorCode;
        }
    }
    
    /*
     * Метод printTD заворачивает строку в теги <td>...</td>
     */
    private function printTD($str){
        print "<td>";
        print $str;
        print "</td>";
    }

    /*
     * Метод printRows распечатывает данные из таблицы organization в виде html-таблицы
     */
    public function printRows($orderField, $order){
        
        
        if(!(($orderField === "organization") 
                OR ($orderField === "address") 
                OR ($orderField === "phone"))){
            $orderField = "organization";
        }

        if($order === "DESC"){
            $sqlEnding = " DESC";
        } else {
            $sqlEnding = "";
        }
        
        $sql = 'SELECT organization, address, phone FROM organizations ORDER BY '.$orderField.$sqlEnding;
        
        print "<table border='1'>";
        print "<tr><th>Наименование</th><th>Адрес</th><th>Телефон</th></tr>";
        foreach ($this->pdo->query($sql) as $row) {
            print "<tr>";
            $this->printTD($row['organization']);
            $this->printTD($row['address']);
            $this->printTD($row['phone']);
            print "</tr>";    
        }
        print "</table>"; 
    }
    
    /*
     * Метод clearTable удаляет данные из таблицы
     */
    public function clearTable(){
        $sql = 'DELETE FROM organizations';
        $this->pdo->query($sql);
    }
}

