<html>
<head>
    <title>z2-5</title>
</head>
<body>
<?php
$lang = $_GET['lang'] ?? '';

if ($lang == 'ru') {
    echo "Русский";
} elseif ($lang == 'en') {
    echo "Английский";
} elseif ($lang == 'fr') {
    echo "Французский";
} elseif ($lang == 'de') {
    echo "Немецкий";
} else {
    echo "Неизвестный язык";
}
?>
</body>
</html>
