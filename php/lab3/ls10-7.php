<html>
<head>
    <title>ls10-7</title>
</head>
<body>
<?php

function printReceivedData($data) {
    foreach ($data as $key=>$value) {
        if (gettype($value) == "array") {
            print "$key : <br>\n";

            foreach ($value as $v ) {
                print "$v<br>";
            }
        }

        else {
            print "$key = $value<br>\n";
        }
    }

    if (empty($data)) {
        print "Нет данных<br>\n";
    }
}

$someData = (isset($_POST)) ? $_POST : $_GET;
printReceivedData($someData);

?>
</body>
</html>
