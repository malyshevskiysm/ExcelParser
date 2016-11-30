<?php
require_once './classes/Organization.class.php';
require_once './classes/Database.class.php';
require_once './classes/ExcelReader.class.php';
require_once './lib/PHPExcel.php';

require_once './include/check_upload.php';
   
$db = new Database();
$db->clearTable();

$ar = ExcelReader::readFile(EXCEL_FILE); 

$flag = 0;
foreach($ar as $ar_colls){
    //Первая строка с заголовками не заносится в базу данных
    if($flag === 0){
        $flag = 1;
        continue;
    }
    $org = new Organization($ar_colls[0], $ar_colls[1], $ar_colls[2]);
    $array['organization'] = $org->getName();
    $array['address'] = $org->getAddress();
    $array['phone'] = $org->getPhone();
    $db->setRow($array);
}

unset($db);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="orgs.php" method="POST">
            <input type="submit" value="Показать организации" />
        </form>
    </body>
</html>

