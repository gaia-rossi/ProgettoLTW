<!-- CONTROLLO SE LA CONNESSIONE SIA DI TIPO POST -->
<?php

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /login/index.html");
    } else {
        // INIALIZZO CONNESSIONE
        $dbconn = pg_connect("host=localhost port=5432
            dbname=WEventData user=postgres password=1234")
            or die('Could not connect: ' . pg_last_error());
    }

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login</title>
</head>
<body>
    
    <?php

        // SE HO UNA CONNESSIONE CON IL DATABASE
        if ($dbconn) {

            // Email inserita
            $email = $_POST['insert_email'];
            // Cerco tutte le tuple con l'email inserita
            $query1 = "SELECT * FROM utente WHERE email=$1";
            $result = pg_query_params($dbconn, $query1, array($email));
            
            if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {

                // HO TROVATO L'EMAIL, CONTROLLO LA PASSWORD
                $pswrd = $_POST['insert_pswrd'];
                $hash = $line["pswrd"];
                
                if (password_verify($pswrd, $hash)) {

                    // LA PASSWORD INSERITA CORRISPONDE ALL'HASH SALVATO
                    $name = $line["nome"];
                    echo "<h1>Il login è andato a buon fine!</h1><br>
                        <a href=../welcome.php?name=$name> Clicca qui per iniziare ad utilizzare il sito </a>";

                } else {

                    // NESSUNA CORRISPONDENZA CON LA PASSWORD
                    echo "<h1>La password è sbagliata!</h1><br>
                        <a href=login.html> Clicca qui per riprovare il login </a>";

                }
            
            } else {

                // NON HO TROVATO L'INDIRIZZO EMAIL NEL DATABASE
                echo "<h1>L'indirizzo e-mail non appartiene a nessun utente registrato!</h1>
                    <a href=../registrazione/registration.html> Clicca qui per registrarti </a>";

            }

        }

        /* Alla fine chiudiamo la connessione. */
        pg_close($dbconn);

    ?>

</body>
</html>