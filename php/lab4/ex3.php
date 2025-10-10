<?php
$servername = "127.0.0.1";
$username = "root";
$password = "wasd5432";
$dbname = "sample";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT * FROM notebook ORDER BY id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ex3</title>
    <style>
        .no-records {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Все записи таблицы notebook</h1>

    <?php
    if ($result) {
        $num_rows = $result->num_rows;
        $num_fields = $conn->field_count;

        if ($num_rows > 0) {
            print("<table border=\"1\">\n");
            print("<tr>\n");

            for ($i = 0; $i < $num_fields; $i++) {
                $field_info = $result->fetch_field_direct($i);
                $field_name = $field_info->name;

                print("<th>");
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
            print("<div class='no-records'>В таблице notebook пока нет записей.</div>");
        }
    } else {
        echo "<p style='color: red;'>Ошибка при выполнении запроса: " . $conn->error . "</p>";
    }

    $conn->close();
    ?>
</body>
</html>
