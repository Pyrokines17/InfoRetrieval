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

$insert1 = "INSERT INTO notebook (name, city, address, birthday, mail) 
            VALUES ('Иванов Иван', 'Москва', 'ул. Ленина, д. 10', '1990-05-15', 'ivan@mail.ru')";

if ($conn->query($insert1) === TRUE) {
    echo "Первая запись успешно добавлена\n";
} else {
    echo "Ошибка при добавлении первой записи: " . $conn->error . "\n";
}

$insert2 = "INSERT INTO notebook (name, city, address, birthday, mail)
            VALUES ('Петрова Анна', 'Санкт-Петербург', 'пр. Невский, д. 25', '1985-12-08', 'anna@gmail.com')";

if ($conn->query($insert2) === TRUE) {
    echo "Вторая запись успешно добавлена\n";
} else {
    echo "Ошибка при добавлении второй записи: " . $conn->error . "\n";
}

$insert3 = "INSERT INTO notebook (name, city, address, birthday, mail)
            VALUES ('Сидоров Петр', 'Екатеринбург', 'ул. Мира, д. 5', '1992-03-22', 'petr@yandex.ru')";

if ($conn->query($insert3) === TRUE) {
    echo "Третья запись успешно добавлена\n";
} else {
    echo "Ошибка при добавлении третьей записи: " . $conn->error . "\n";
}

$conn->close();
?>
