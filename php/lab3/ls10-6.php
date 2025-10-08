<html>
<head>
    <title>ls10-6</title>
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
}

$someData = $_POST;
printReceivedData($someData);

?>
</body>
</html>
