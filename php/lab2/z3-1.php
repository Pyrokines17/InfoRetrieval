<html>
<head>
    <title>z3-1</title>
</head>
<body>
<?php

$a = 1;
$b = 1;
$color = "green";

print "<table border=1 cellpadding=5>\n";

while ($a <= 10) {
    print "<tr>\n";

    $b = 1;
    while ($b <= 10) {
        if ($a == $b) {
            print "\t<td bgcolor='$color'>";
        } else {
            print "\t<td>";
        }

        print ($a * $b);
        print "</td>\n";

        $b++;
    }
    print "</tr>\n";

    $a++;
}

print "</table>";

?>
</body>
</html>
