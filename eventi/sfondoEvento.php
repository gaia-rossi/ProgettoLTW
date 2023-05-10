<?php
    session_start();
?>
<?php 
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    <script defer src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery-3.6.0.js"></script>
    <title>Sfondo Evento</title>
</head>
<body>
    <?php
        if($dbconn){
            $nome = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];
            $query = "SELECT * from evento where nome=$1 and datae=$2";
            $result = pg_query_params($dbconn, $query, array($nome, $data));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            if($line != false){
                $categoria = $line["categoria"];
                echo "<img src='./icons/$categoria.jpg' class='card-img' alt='$categoria'>";
                echo "<script> alert('inserita foto') <script>";
            } 
            pg_close($dbconn);
        }
    ?>
</body>
</html>