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
    <title>Pagina di iscrizione</title>
</head>
<body>
    <?php
        if($dbconn){
            $post = $_POST["contenuto"];
            $evento = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];
            $utente = $_SESSION["email"];
            //calcolo numero di post presenti
            $query = "SELECT count(*) as tot from post where $1";
            $result = pg_query_params($dbconn, $query, array("true"));
            $line = pg_fetch_array($result);
            $numero = $line["tot"] + 1;

            //inserisco il nuovo post
            $query2 = "INSERT INTO post (numero, nomee, datae, autore, contenuto)
                        VALUES ($1, $2, $3, $4, $5)";
            $result2 = pg_query_params($dbconn, $query2,array($numero, $evento, $data, $utente, $post));
            if($result2){
                echo "Postato correttamente correttamente!<br>
                clicca <a href='../eventi/paginaEvento.html'> QUI </a> per vedere la lista degli eventi aggiornata";
            } else {
                die("Qualcosa è andato storto. Prova di nuovo");
            }
            pg_close($dbconn);
        }
    ?>
</body>
</html>