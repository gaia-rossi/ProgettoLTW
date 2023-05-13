<?php
    // Start della sessione
    session_start();
?>
<!-- CONTROLLO SE LA CONNESSIONE SIA DI TIPO POST -->
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // INIALIZZO CONNESSIONE
        $dbconn = pg_connect("host=localhost port=5432
            dbname=WEvent user=postgres password=1234")
            or die('Could not connect: ' . pg_last_error());
    }

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiornamento Password</title>
</head>
<body>
    
    <?php

        // SE HO UNA CONNESSIONE CON IL DATABASE
        if ($dbconn) {

            // Email inserita
            $email = $_SESSION['email'];
            // Cerco l'email nel database per accedere a tutti gli altri campi
            $query1 = "SELECT * FROM utente WHERE email=$1";
            $result = pg_query_params($dbconn, $query1, array($email));
            
            if ($line = pg_fetch_array($result, null)) {

                $new_pass = $_POST["new_pswrd"];
                $new_hash = password_hash($new_pass, PASSWORD_BCRYPT);

                // QUERY PER MODIFICARE LA TUPLA NEL DATABASE
                $query2 = "UPDATE utente SET pswrd = $1
                            WHERE email=$2";
                $result = pg_query_params($dbconn, $query2, array(
                    $new_hash, $email
                ));

                // TUPLA MODIFICATA
                if ($result) {
                    $_SESSION['password'] = $new_pass;
                    header("Location: ./area_riservata.html");
                    exit();
                } else {
                    die("La modifica non è andata a buon fine.");
                }
            }

        }

        /* Alla fine chiudiamo la connessione. */
        pg_close($dbconn);

    ?>

</body>
</html>