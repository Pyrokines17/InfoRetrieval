<html>
<head>
    <title>z3-2</title>
</head>
<body>
<?php

$color = "green";

print "<table border=1 cellpadding=5>\n";

for ($a = 1; $a <= 10; $a++) {
    print "<tr>\n";

    for ($b = 1; $b <= 10; $b++) {
        if ($a == 1 && $b == 1) {
            print "\t<td><font color='red'>+</font></td>\n";
        } elseif ($a == 1) {
            print "\t<td><font color='$color'>$b</font></td>\n";
        } elseif ($b == 1) {
            print "\t<td><font color='$color'>$a</font></td>\n";
        } else {
            print "\t<td>" . ($a + $b) . "</td>\n";
        }
    }

    print "</tr>\n";
}

print "</table>";

?>
</body>
</html>
