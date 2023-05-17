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
    <title>Inserisci commenti</title>
</head>
<body>
    <?php
        if($dbconn){
            //devi ottenere il numero del post E il contenuto in qualche modo

            $utente = $_SESSION["email"];
            $evento = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];

            //inserisco il nuovo commento
            $query = "DELETE from iscritti where email=$1 and nomee=$2 and datae=$3";
            $result = pg_query_params($dbconn, $query,array($utente, $evento, $data));
            if($result){
                echo "Ti sei disiscritto correttamente!<br>
                clicca <a href='../paginaIniziale.html'> QUI </a> per vedere altri eventi";
            } else {
                die("Qualcosa è andato storto. Prova di nuovo");
            }
            pg_close($dbconn);
        }
    ?>
</body>
</html>