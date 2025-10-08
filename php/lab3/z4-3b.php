<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>z4-3b</title>
    <style>
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .name {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .score {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        .result {
            font-size: 18px;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .excellent { background-color: #d4edda; color: #155724; }
        .good { background-color: #d1ecf1; color: #0c5460; }
        .average { background-color: #fff3cd; color: #856404; }
        .poor { background-color: #f8d7da; color: #721c24; }
        .back-btn {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Результаты теста</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otv = array("6", "9", "4", "1", "3", "2", "5", "8", "7");

    $name = htmlspecialchars($_POST['name']);

    $correct_count = 0;

    for ($i = 1; $i <= 9; $i++) {
        $user_answer = $_POST["q$i"];
        if ($user_answer == $otv[$i-1]) {
            $correct_count++;
        }
    }

    echo "<div class='name'>Тестируемый: <strong>$name</strong></div>";
    echo "<div class='score'>Правильных ответов: $correct_count из 9</div>";

    switch ($correct_count) {
        case 9:
            $result = "великолепно знаете географию";
            $class = "excellent";
            break;
        case 8:
            $result = "отлично знаете географию";
            $class = "excellent";
            break;
        case 7:
            $result = "очень хорошо знаете географию";
            $class = "good";
            break;
        case 6:
            $result = "хорошо знаете географию";
            $class = "good";
            break;
        case 5:
            $result = "удовлетворительно знаете географию";
            $class = "average";
            break;
        case 4:
            $result = "терпимо знаете географию";
            $class = "average";
            break;
        case 3:
            $result = "плохо знаете географию";
            $class = "poor";
            break;
        case 2:
            $result = "очень плохо знаете географию";
            $class = "poor";
            break;
        default:
            $result = "вообще не знаете географию";
            $class = "poor";
            break;
    }

    echo "<div class='result $class'>Вы $result</div>";
} else {
    echo "<p>Ошибка: данные не были переданы!</p>";
}
?>

        <a href="z4-3a.htm" class="back-btn">Пройти тест заново</a>
    </div>
</body>
</html>
