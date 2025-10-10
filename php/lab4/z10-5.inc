<?php

function vid_structure($name) {
    print("<h4>Структура таблицы: $name</h4>");

    global $conn;

    $sql = "SELECT * FROM `$name`";
    $result = $conn->query($sql);

    if ($result === false) {
        print("<p>Ошибка выполнения запроса: " . htmlspecialchars($conn->error) . "</p>");
        return;
    }

    $type_names = array(
        MYSQLI_TYPE_DECIMAL => 'DECIMAL',
        MYSQLI_TYPE_TINY => 'TINYINT',
        MYSQLI_TYPE_SHORT => 'SMALLINT',
        MYSQLI_TYPE_LONG => 'INT',
        MYSQLI_TYPE_FLOAT => 'FLOAT',
        MYSQLI_TYPE_DOUBLE => 'DOUBLE',
        MYSQLI_TYPE_NULL => 'NULL',
        MYSQLI_TYPE_TIMESTAMP => 'TIMESTAMP',
        MYSQLI_TYPE_LONGLONG => 'BIGINT',
        MYSQLI_TYPE_INT24 => 'MEDIUMINT',
        MYSQLI_TYPE_DATE => 'DATE',
        MYSQLI_TYPE_TIME => 'TIME',
        MYSQLI_TYPE_DATETIME => 'DATETIME',
        MYSQLI_TYPE_YEAR => 'YEAR',
        MYSQLI_TYPE_NEWDATE => 'DATE',
        MYSQLI_TYPE_VAR_STRING => 'VARCHAR',
        MYSQLI_TYPE_BIT => 'BIT',
        MYSQLI_TYPE_JSON => 'JSON',
        MYSQLI_TYPE_NEWDECIMAL => 'DECIMAL',
        MYSQLI_TYPE_ENUM => 'ENUM',
        MYSQLI_TYPE_SET => 'SET',
        MYSQLI_TYPE_TINY_BLOB => 'TINYBLOB',
        MYSQLI_TYPE_MEDIUM_BLOB => 'MEDIUMBLOB',
        MYSQLI_TYPE_LONG_BLOB => 'LONGBLOB',
        MYSQLI_TYPE_BLOB => 'BLOB',
        MYSQLI_TYPE_STRING => 'CHAR',
        MYSQLI_TYPE_GEOMETRY => 'GEOMETRY'
    );

    $num_fields = $conn->field_count;

    print("<dl><dd>\n");

    for ($i = 0; $i < $num_fields; $i++) {
        $field_info = $result->fetch_field_direct($i);

        $type_name = isset($type_names[$field_info->type]) ? $type_names[$field_info->type] : $field_info->type;

        $flags_text = "";
        if ($field_info->flags & MYSQLI_NOT_NULL_FLAG) $flags_text .= "NOT_NULL ";
        if ($field_info->flags & MYSQLI_PRI_KEY_FLAG) $flags_text .= "PRIMARY_KEY ";
        if ($field_info->flags & MYSQLI_UNIQUE_KEY_FLAG) $flags_text .= "UNIQUE_KEY ";
        if ($field_info->flags & MYSQLI_AUTO_INCREMENT_FLAG) $flags_text .= "AUTO_INCREMENT ";

        print "<i>";
        print $type_name;
        print "</i> <i>";
        print $field_info->length;
        print "</i> <b>";
        print $field_info->name;
        print "</b> <i>";
        print $flags_text;
        print "</i><br>\n";
    }
    print("</dd></dl>\n");

    $result->free();
}

function vid_content($name) {
    print("<h4>Содержимое таблицы: $name</h4>");

    global $conn;

    $sql = "SELECT * FROM `$name`";
    $result = $conn->query($sql);

    if ($result === false) {
        print("<p>Ошибка выполнения запроса: " . htmlspecialchars($conn->error) . "</p>");
        return;
    }

    $rus_name = array(
        "cnum" => "Номер покупателя",
        "cname" => "Имя покупателя",
        "city" => "Город",
        "rating" => "Рейтинг покупателя",
        "snum" => "Номер продавца",
        "sname" => "Имя продавца",
        "comm" => "Комиссионные",
        "onum" => "Номер заказа",
        "amt" => "Сумма",
        "odate" => "Дата заказа"
    );

    $num_rows = $result->num_rows;
    $num_fields = $conn->field_count;

    if ($num_rows > 0) {
        print("<table border=\"1\">\n");
        print("<tr>\n");

        for ($i = 0; $i < $num_fields; $i++) {
            $field_info = $result->fetch_field_direct($i);
            $field_name = $field_info->name;

            print("<th>");
            if (array_key_exists($field_name, $rus_name)) {
                print(htmlspecialchars($rus_name[$field_name]));
                print("<br>");
            }
            print(htmlspecialchars($field_name));
            print("</th>\n");
        }

        print("</tr>\n");

        while ($a_row = $result->fetch_row()) {
            print("<tr>\n");
            foreach ($a_row as $field) {
                print("\t<td>" . htmlspecialchars($field) . "</td>\n");
            }
            print("</tr>\n");
        }
        print("</table>\n");
    } else {
        print("<p>Таблица пуста.</p>");
    }
}

if (!isset($conn) || $conn->connect_error) {
    print("<p>No database connection.</p>");
    die("Подключение к БД недоступно");
}

$structure = "";
$content = "";

if (isset($_GET['structure']) && is_array($_GET['structure']) && count($_GET['structure']) > 0) {
    $structure = $_GET['structure'][0];

    if (isset($structure) && $structure != "") {
        vid_structure($structure);
    }
} else {
    print("<h4>Нет данных для отображения структуры</h4>");
}

if (isset($_GET['content']) && is_array($_GET['content']) && count($_GET['content']) > 0) {
    $content = $_GET['content'][0];

    if (isset($content) && $content != "") {
        vid_content($content);
    }
} else {
    print("<h4>Нет данных для отображения содержимого</h4>");
}

print("<a href=\"z10-1.htm\">back</a>");

?>
