<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>Фильтровать</h3>
        <strong>Организации</strong>
            <a href="orgs.php?filter=organization">По возрастанию</a>
            <a href="orgs.php?filter=organization&order=desc">По убыванию</a>
        <br />
        
        <strong>Адрес</strong>
            <a href="orgs.php?filter=address">По возрастанию</a>
            <a href="orgs.php?filter=address&order=desc">По убыванию</a>
        <br />
        
        <strong>Телефон</strong>
            <a href="orgs.php?filter=phone">По возрастанию</a>
            <a href="orgs.php?filter=phone&order=desc">По убыванию</a>
        <br />
        <br />
        
<?php

require_once './classes/Database.class.php';

require_once './include/table_order.php';

$db = new Database();

$db->printRows($listFilter, $listOrder);

?>

    </body>
</html>
