<?php

/*
 * Интерфейс IOrganization позволяет выполнять операции установки значений и 
 * считывания элементов
 */
interface IOrganization { 

    public function setName($name);
    
    public function getName();
    
    public function setAddress($address); 
    
    public function getAddress();
    
    public function setPhone($phone);  
    
    public function getPhone();
} 

