<?php
require_once 'IOrganization.php';

/*
 * Класс Organization является POJO классом отображающим структуру записи организации
 * 
 * @author Malyshevskiy Sergey
 */
class Organization implements IOrganization{ 
    private $name; 
    private $address; 
    private $phone;
    
    function __construct($name, $address, $phone){
        $this->setName($name);
        $this->setAddress($address); 
        $this->setPhone($phone); 
    }
    
    public function setName($name) { 
        $this->name = $name; 
    } 
    
    public function getName() {
        return $this->name;
    }
    
    public function setAddress($address) { 
        $this->address = $address; 
    } 
    
    public function getAddress() {
        return $this->address;
    }
    
    public function setPhone($phone) { 
        $this->phone = $phone; 
    } 
    
    public function getPhone() {
        return $this->phone;
    }
} 



