<?php
$list_sites = array(
    "Yandex" => "https://yandex.ru/search/?text=",
    "Google" => "https://www.google.com/search?q=",
    "Yahoo" => "https://search.yahoo.com/search?p=",
    "Bing" => "https://www.bing.com/search?q=",
    "DuckDuckGo" => "https://duckduckgo.com/?q=",
);

if (isset($_GET['site']) && !empty($_GET['site'])) {
    $site = $_GET['site'];
    header("Location: $site");
    exit();
}
?>

<html lang="ru">
<head>
    <title>z4-5</title>
    <meta charset="UTF-8">
    <style>
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Выбор поисковой системы</h1>

        <form method="GET" action="">
            <div class="form-group">
                <label for="site">Выберите поисковую систему:</label>
                <select name="site" id="site" required>
                    <option value="">-- Выберите поисковую систему --</option>
                    <?php
                    $keys = array_keys($list_sites);
                    $i = 0;
                    $count = count($list_sites);

                    while ($i < $count) {
                        $name = $keys[$i];
                        $url = $list_sites[$name];
                        echo "<option value=\"$url\">$name</option>\n";
                        $i++;
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="submit-btn">Перейти к поиску</button>
        </form>
    </div>
</body>
</html>
