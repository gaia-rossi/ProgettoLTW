<?php
    // Start della sessione
    session_start();
?>
<?php 
    // Connessione al database
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>

    <?php

        if($dbconn){

            $mail = $_SESSION['email'];
            $query = "SELECT * from utente where email=$1";
            $result = pg_query_params($dbconn, $query, array($mail));

            $line=pg_fetch_array($result, null, PGSQL_ASSOC);

            if ($line != false) {

                $head=$line["head"];
                $pfpic=$line["pfpic"];

                

            } 

            pg_close($dbconn);

        }

    ?>

</body>
</html>






















