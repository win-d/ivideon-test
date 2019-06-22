<?php
// получить дату вставки новостей
$insert = $_REQUEST['insert'];
$insertTs = strtotime($insert);
$sql = «SELECT * FROM news WHERE insert = '« . $insert . «'«;

$res = mysql_query($sql);
while ($item = mysql_fetch_assoc($res)) {
    // перебираем новости и для каждой новости отображаем ее анонс
    echo 'News ' . $item['title'] . ': ' . «\n»;
    $sql = 'SELECT * FROM announce WHERE item_id = ' . $item['id'];
    $res2 = mysql_query($sql);
    while ($item = mysql_fetch_assoc($res2)) {
        echo $announce['text'] . «\n»;
        if ($item['is_new']) {
            $mainItem = $item;
        }
    }
    echo 'Main news item: ' . $mainItem['id'] . «\n»;
}
echo date('Y-m-d H:i:s', $insertTs);

/**
 * 1. Строка 5:
 * 1.1. Неправильная инициализация переменной $sql, правильно будет так:
 * $sql = 'SELECT * FROM news WHERE insert = ' . $insert;
 * или так:
 * $sql = "SELECT * FROM news WHERE insert = $insert";
 * 1.2. Если не нужны абсолютно все поля, вместо оператора "*" лучше указывать только нужные колонки
 *
 * 2. Строка 7:
 * 2.1. Так как мы получаем данные из $_REQUEST (строка 3), следует подготовить SQL-выражение перед запросом в БД (например, через $mysqli->prepare($query) или $mysqli->real_escape_string($query))
 * 2.2. Функция выполнения запроса mysql_query(...) объявлена устаревшей. Если версия PHP >= 5.5.0, то вместо неё следует использовать mysqli_query(...) или PDO::query().
 * 2.3. Вместо процедурного стиля можно использовать объектно-ориентированный подход.
 *
 * 3. Строка 8:
 * 3.1. Функция возврата запроста из БД mysql_fetch_assoc($result) объявлена устаревшей. Если версия PHP >= 5.5.0, то вместо неё следует использовать mysqli_fetch_assoc(...) или PDOStatement::fetch(...).
 * 3.2. Вместо процедурного стиля можно использовать объектно-ориентированный подход.
 *
 * 4. Строка 10:
 * 4.1. Оператор перехода на новую строку должен быть заключён в двойные прямые (а не угловые) кавычки.
 * 4.2. Раз мы выводим текст, а не пишем в файл, то вместо оператора \n правильно будет использовать тег <br> или функцию nl2br(string $string);
 *
 * 5. Строка 11:
 * 5.1. Используется запрос в цикле, поэтому количество запросов равняется N + 1. Необходимо оптимизировать этот момент. Например, с помощью оператора IN(...).
 *
 * 6. Строка 12:
 * 6.1. См. п. 2.
 *
 * 7. Строка 13:
 * 7.1. См. п. 3.
 *
 * 8. Строка 14:
 * 8.1. Неизвестная переменная $announce.
 * 8.2. См. п. 4.
 *
 * 9. Строка 16:
 * 9.1. Вместо присвоения и хранения целого массива, переменной $mainItem можно присвоить $item['id']. Только оно используется дальше в коде программы.
 *
 * 10. Строка 19:
 * 10.1. Переменная $mainItem может быть пустой. Следует обернуть данную строку в конструкцию if...else.
 * 10.2. См. п. 4.
*/