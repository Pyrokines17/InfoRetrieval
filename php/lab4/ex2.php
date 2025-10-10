<?php
$servername = "127.0.0.1";
$username = "root";
$password = "wasd5432";
$dbname = "sample";

if ($_POST) {
    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $city = trim($_POST['city']);
    $address = trim($_POST['address']);
    $birthday = $_POST['birthday'];

    if (!empty($name) && !empty($mail)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        $birthday_final = "1970-01-01";

        if (!empty($birthday)) {
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
                $date_parts = explode('-', $birthday);
                if (checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
                    $birthday_final = $birthday;
                }
            }
        }

        $birthday = $birthday_final;

        $query = "INSERT INTO notebook (name, city, address, birthday, mail) VALUES ('$name', '$city', '$address', '$birthday', '$mail')";
        $result = $conn->query($query);

        if ($result === TRUE) {
            echo "<p style='color: green;'>Запись успешно добавлена в таблицу notebook!</p>";
        } else {
            echo "<p style='color: red;'>Ошибка при добавлении записи:</p>";
        }

        $conn->close();
    } else {
        echo "<p style='color: red;'>Поля 'Имя' и 'Email' обязательны для заполнения!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ex2</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Добавление записи в таблицу notebook</h1>

    <form method="POST" action="ex2.php">
        <div class="form-group">
            <label for="name">Имя <span class="required">*</span>:</label>
            <input type="text" id="name" name="name" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="city">Город:</label>
            <input type="text" id="city" name="city" maxlength="50">
        </div>

        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" maxlength="50">
        </div>

        <div class="form-group">
            <label for="birthday">Дата рождения:</label>
            <input type="text" id="birthday" name="birthday" maxlength="50" placeholder="YYYY-MM-DD">
        </div>

        <div class="form-group">
            <label for="mail">Email <span class="required">*</span>:</label>
            <input type="email" id="mail" name="mail" maxlength="20" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Добавить запись">
        </div>
    </form>

    <p><small><span class="required">*</span> - обязательные поля</small></p>
</body>
</html>
