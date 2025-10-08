<?php
$align = isset($_POST['align']) ? $_POST['align'] : 'left';
$valign_array = isset($_POST['valign']) ? $_POST['valign'] : array();
$valign = !empty($valign_array) ? $valign_array[0] : 'top';

$form_submitted = isset($_POST['submit']);
?>

<html lang="ru">
<head>
    <title>z4-2</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Выберите выравнивание текста в таблице</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Горизонтальное выравнивание (align):</legend>
            <label><input type="radio" name="align" value="left" <?php echo ($align == 'left') ? 'checked' : ''; ?>> Слева</label><br>
            <label><input type="radio" name="align" value="center" <?php echo ($align == 'center') ? 'checked' : ''; ?>> По центру</label><br>
            <label><input type="radio" name="align" value="right" <?php echo ($align == 'right') ? 'checked' : ''; ?>> Справа</label>
        </fieldset>

        <fieldset>
            <legend>Вертикальное выравнивание (valign):</legend>
            <label><input type="checkbox" name="valign[]" value="top" <?php echo (in_array('top', $valign_array)) ? 'checked' : ''; ?>> Сверху</label><br>
            <label><input type="checkbox" name="valign[]" value="middle" <?php echo (in_array('middle', $valign_array)) ? 'checked' : ''; ?>> По центру</label><br>
            <label><input type="checkbox" name="valign[]" value="bottom" <?php echo (in_array('bottom', $valign_array)) ? 'checked' : ''; ?>> Снизу</label>
        </fieldset>

        <br>
        <button type="submit" name="submit">Выполнить</button>
    </form>

    <?php if ($form_submitted): ?>
    <hr>
    <h3>Результат:</h3>
    <table border="1">
        <tr>
            <td width="100" height="100" align="<?php echo htmlspecialchars($align); ?>" valign="<?php echo htmlspecialchars($valign); ?>">
                Текст
            </td>
        </tr>
    </table>
    <?php endif; ?>

</body>
</html>
