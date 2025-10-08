<?php
$align = isset($_POST['align']) ? $_POST['align'] : 'left';
$valign_array = isset($_POST['valign']) ? $_POST['valign'] : array();
$valign = !empty($valign_array) ? $valign_array[0] : 'top';
?>

<html lang="ru">
<head>
    <title>z4-1b</title>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <tr>
            <td width="100" height="100" align="<?php echo htmlspecialchars($align); ?>" valign="<?php echo htmlspecialchars($valign); ?>">
                Текст
            </td>
        </tr>
    </table>

    <br>
    <a href="z4-1a.htm">Назад</a>
</body>
</html>
