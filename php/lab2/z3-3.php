<html>
<head>
    <title>z3-3</title>
</head>
<body>
<?php

function Ru($color) {
    echo "<font color='$color'>Здравствуйте!</font>";
}

function En($color) {
    echo "<font color='$color'>Hello!</font>";
}

function Fr($color) {
    echo "<font color='$color'>Bonjour!</font>";
}

function De($color) {
    echo "<font color='$color'>Guten Tag!</font>";
}

$lang = $_GET['lang'] ?? '';
$color = $_GET['color'] ?? 'black';

if (function_exists($lang)) {
    $lang($color);
} else {
    echo "Invalid language parameter";
}

?>

</body>
</html>
