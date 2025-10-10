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

$edit_id = null;
if ($_POST && isset($_POST['id'])) {
    $edit_id = intval($_POST['id']);
}

if ($_POST && isset($_POST['update_record']) && isset($_POST['record_id']) && isset($_POST['field_name']) && isset($_POST['field_value'])) {
    $record_id = intval($_POST['record_id']);
    $field_name = $_POST['field_name'];
    $field_value = $_POST['field_value'];

    $allowed_fields = ['name', 'city', 'address', 'birthday', 'mail'];
    if (in_array($field_name, $allowed_fields)) {
        if ($field_name === 'birthday') {
            $birthday_final = "1970-01-01";

            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $field_value)) {
                $date_parts = explode('-', $field_value);
                if (checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
                    $birthday_final = $field_value;
                }
            }

            $field_value = $birthday_final;
        }

        $q = "UPDATE notebook SET `$field_name` = '$field_value' WHERE id = $record_id";
        $res = $conn->query($q);

        if ($res === TRUE) {
            echo "<div style='color: green; padding: 10px; margin: 10px 0; border: 1px solid green; background-color: #f0fff0;'>Запись успешно обновлена!</div>";
        } else {
            echo "<div style='color: red; padding: 10px; margin: 10px 0; border: 1px solid red; background-color: #fff0f0;'>Ошибка при обновлении: " . $conn->error . "</div>";
        }
    }

    $edit_id = null;
}

$sql = "SELECT * FROM notebook ORDER BY id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ex4</title>
    <style>
        .no-records {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }
        .edit-form {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .edit-form select, .edit-form input[type="text"] {
            margin: 5px;
            padding: 5px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .cancel-button {
            background-color: #f44336;
        }
        .cancel-button:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
<?php
if ($edit_id) {
    $query = "SELECT * FROM notebook WHERE id = '$edit_id'";
    $edit_result = $conn->query($query);

    if ($edit_result->num_rows > 0) {
        $record = $edit_result->fetch_assoc();
        ?>
        <div class="edit-form">
            <h2>Редактирование записи ID: <?php echo $edit_id; ?></h2>
            <form method="POST">
                <input type="hidden" name="record_id" value="<?php echo $edit_id; ?>">
                <input type="hidden" name="update_record" value="1">

                <label for="field_name">Выберите поле для изменения:</label>
                <select name="field_name" id="field_name" required>
                    <option value="">-- Выберите поле --</option>
                    <option value="name">Имя (текущее: <?php echo htmlspecialchars($record['name']); ?>)</option>
                    <option value="city">Город (текущее: <?php echo htmlspecialchars($record['city']); ?>)</option>
                    <option value="address">Адрес (текущее: <?php echo htmlspecialchars($record['address']); ?>)</option>
                    <option value="birthday">День рождения (текущее: <?php echo htmlspecialchars($record['birthday']); ?>)</option>
                    <option value="mail">Email (текущее: <?php echo htmlspecialchars($record['mail']); ?>)</option>
                </select>

                <label for="field_value">Новое значение:</label>
                <input type="text" name="field_value" id="field_value" required>

                <br><br>
                <button type="submit" class="button">Обновить запись</button>
                <button type="button" class="button cancel-button" onclick="window.location.href='ex4.php'">Отмена</button>
            </form>
        </div>
        <?php
    } else {
        echo "<p style='color: red;'>Запись с ID $edit_id не найдена.</p>";
    }
} else {
    if ($result) {
        print("<h1>Все записи таблицы notebook</h1>\n");

        $num_rows = $result->num_rows;
        $num_fields = $conn->field_count;

        if ($num_rows > 0) {
            ?>
            <form method="POST">
            <?php
            print("<table border=\"1\">\n");
            print("<tr>\n");

            for ($i = 0; $i < $num_fields; $i++) {
                $field_info = $result->fetch_field_direct($i);
                $field_name = $field_info->name;

                print("<th>");
                print(htmlspecialchars($field_name));
                print("</th>\n");
            }

            print("<th>Change</th>\n");
            print("</tr>\n");

            while ($a_row = $result->fetch_row()) {
                print("<tr>\n");
                foreach ($a_row as $field) {
                    print("\t<td>" . htmlspecialchars($field) . "</td>\n");
                }
                print("\t<td><input type=\"radio\" name=\"id\" value=\"" . $a_row[0] . "\"></td>\n");
                print("</tr>\n");
            }

            print("</table>\n");
            ?>
            <br>
            <button type="submit" class="button">Заменить</button>
            </form>
            <?php
        } else {
            print("<div class='no-records'>В таблице notebook пока нет записей.</div>");
        }
    } else {
        echo "<p style='color: red;'>Ошибка при выполнении запроса: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
</body>
</html>
