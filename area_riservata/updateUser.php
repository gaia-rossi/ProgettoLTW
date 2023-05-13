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
    <title>Aggiornamento Dati</title>
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

                // Devo controllare che la password sia la stessa
                $pswrd = $_POST["insert_pswrd"];
                $hash = $line["pswrd"];

                $new_name = $_POST["insert_name"];
                $new_region = $_POST["insert_region"];
                $new_city = $_POST["insert_city"];

                // QUERY PER MODIFICARE LA TUPLA NEL DATABASE
                $query2 = "UPDATE utente SET (nome, regione, citta) = ($1,$2,$3)
                            WHERE email=$4";
                $result = pg_query_params($dbconn, $query2, array(
                    $new_name, $new_region, $new_city, $email
                ));

                // TUPLA MODIFICATA
                if ($result) {

                    // Inizializzo la sessione
                    $_SESSION['nome'] = $new_name;

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