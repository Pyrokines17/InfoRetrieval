<html>
<head>
    <title>z3-6</title>
</head>
<body>
<?php

$cust = array(
    'cnum' => 2001,
    'cname' => 'Hoffman',
    'city' => 'London',
    'snum' => 1001,
    'rating' => 100
);

echo "Исходный ассоциативный массив:<br>";
foreach ($cust as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
echo "<br>";

asort($cust);
echo "Сортировка по значениям (asort):<br>";
foreach ($cust as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
echo "<br>";

ksort($cust);
echo "Сортировка по ключам (ksort):<br>";
foreach ($cust as $key => $value) {
    echo $key . " => " . $value . "<br>";
}
echo "<br>";

sort($cust);
echo "Сортировка с помощью sort():<br>";
foreach ($cust as $value) {
    echo $value . "<br>";
}

?>
</body>
</html>
