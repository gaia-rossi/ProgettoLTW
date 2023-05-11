//commenti TODOO
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
            //devi ottenere il numero del post E il contenuto in qualche modo
            $npost = ;
            $contenuto =;

            $utente = $_SESSION["email"];

            //inserisco il nuovo commento
            $query = "INSERT INTO commenti (numerop, contenuto, autore)
                        VALUES ($1, $2, $3)";
            $result = pg_query_params($dbconn, $query,array($npost, $contenuto, $utente));
            if($result){
                echo "Commento inserito correttamente!<br>
                clicca <a href='../paginaEvento.php'> QUI </a> per vedere la lista degli eventi aggiornata";
            } else {
                die("Qualcosa è andato storto. Prova di nuovo");
            }
            pg_close($dbconn);
        }
    ?>
</body>
</html>