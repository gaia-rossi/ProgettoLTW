<?php
if(isset($_GET["errore"])){
    $errore = $_GET["errore"];
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- IMPORT CSS/BOOTSTRAP -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/login.css"/>
    
    <title>Errori</title>
</head>
<body>

    <div class="form-div text-center container-fluid">

        <h4><?php echo"$errore" ?></h4>

    </div>

</body>
</html>