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
    <title>Pagina di iscrizione</title>
</head>
<body>
    <?php
        if($dbconn){
            $evento = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];
            $utente = $_SESSION["email"];

            $query = "SELECT * from iscritti where email=$1 and nomee=$2 and datae=$3";
            $result = pg_query_params($dbconn, $query, array($utente, $evento, $data));
            if($line=pg_fetch_array($result)){
                echo "Risulti già iscritto! clicca <a href='./paginaIniziale.html'> QUI </a>
                    vedere tutti gli eventi"; //cambiare indirizzo
            } else {
                $query2 = "INSERT INTO iscritti (email, nomeE, dataE)
                            VALUES ($1, $2, $3)";
                $result = pg_query_params($dbconn, $query2,array($utente, $evento, $data));
                if($result){
                    echo "Iscritto correttamente!<br>
                    clicca <a href='./paginaIniziale.html'> QUI </a> per vedere la lista degli eventi aggiornata";
                } else {
                    die("l'inserimento non è andato a buon fine. Prova di nuovo");
                }
        }
            pg_close($dbconn);
        }
    ?>
</body>
</html>