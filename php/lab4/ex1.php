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

$drop_sql = "DROP TABLE IF EXISTS notebook";

if ($conn->query($drop_sql) === TRUE) {
    echo "Таблица notebook удалена (если существовала)\n";
} else {
    echo "Ошибка при удалении таблицы: " . $conn->error . "\n";
}

$create_sql = "CREATE TABLE notebook (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(50),
    city VARCHAR(50),
    address VARCHAR(50),
    birthday DATE,
    mail VARCHAR(20)
)";

if ($conn->query($create_sql) === TRUE) {
    echo "Таблица notebook успешно создана\n";
} else {
    echo "Нельзя создать таблицу notebook: " . $conn->error . "\n";
}

$conn->close();
?>
