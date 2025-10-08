<html>
<head>
    <title>z3-5</title>
</head>
<body>
<?php

$treug = array();
for ($n = 1; $n <= 10; $n++) {
    $treug[] = $n * ($n + 1) / 2;
}

echo "Треугольные числа: ";
foreach ($treug as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

$kvd = array();
for ($i = 1; $i <= 10; $i++) {
    $kvd[] = $i * $i;
}

echo "Квадраты чисел: ";
foreach ($kvd as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

$rez = array_merge($treug, $kvd);
echo "Объединенный массив: ";
foreach ($rez as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

sort($rez);
echo "Отсортированный массив: ";
foreach ($rez as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

array_shift($rez);
echo "После удаления первого элемента: ";
foreach ($rez as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

$rez1 = array_unique($rez);
echo "После удаления повторяющихся элементов: ";
foreach ($rez1 as $value) {
    echo $value . "  ";
}
echo "\n<br><br>";

?>
</body>
</html>
