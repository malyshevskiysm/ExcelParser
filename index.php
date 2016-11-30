<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="request.php" method="POST">
            <!-- Максимальный размер загружаемого файла 30 Мб -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
            <!-- Тип загружаемого файла должен быть Excel Files 97-2003 (.xls) -->
            <input name="userfile" type="file" accept="application/vnd.ms-excel"/>
            <input type="submit" value="Импорт организаций" />
        </form>
    </body>
</html>
