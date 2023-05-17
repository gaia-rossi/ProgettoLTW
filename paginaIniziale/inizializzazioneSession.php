<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo"<h3>Bentornato/a <span style='color:navy;'>" . $_SESSION['nome'] . "</span>!</h3>";
    ?>
</body>
</html>