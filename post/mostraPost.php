<?php
    session_start();
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

    <title>Lista post</title>
</head>
<body>
    <?php
        if($dbconn){
            $evento = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];

            $query = "SELECT * from post where nomee=$1 and datae=$2";
            $result = pg_query_params($dbconn, $query, array($evento, $data));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            while($line != false){
                $utente =$line["autore"];
                $contenuto=$line["contenuto"];
                echo "<div class='card card-b'>";
                echo "  <div class='card-header'>";
                echo $utente;
                echo "  </div>";            
                echo "  <div class='card-body'>";
                echo $contenuto;
                echo "  </div>"; 
                echo "</div>";
                $line=pg_fetch_array($result, null, PGSQL_ASSOC); 
            } 
            pg_close($dbconn);
        }
    ?>
</body>
</html>