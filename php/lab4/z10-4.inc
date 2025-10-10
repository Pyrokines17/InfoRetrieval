<?php
$servername = "127.0.0.1";
$username = "root";
$password = "wasd5432";
$dbname = "my_project_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    print("<p>Could not connect to database.</p>");
    die("Соединение не установлено: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
