<?php

$listOrder;
$listFilter;

//Определение порядка следования записей - по возрастанию или по убыванию
if (isset($_GET['order'])) {
    if($_GET['order'] == "desc"){
        $listOrder = "DESC";
    }
}

//Определение поля, по которому фильтруется таблица
if (isset($_GET['filter'])) {
    $listFilter = "organization";

    if(($_GET['filter'] == "address") || ($_GET['filter'] == "phone")){
        $listFilter = $_GET['filter'];   
    }
}

