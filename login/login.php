<?php
    // Inizializzo la sessione
    session_unset();
    session_start();
?>
<!-- CONTROLLO SE LA CONNESSIONE SIA DI TIPO POST -->
<?php

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /login/login.html");
    } else {
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

                    // Inizializzo la sessione
                    $_SESSION['nome'] = $name;
                    $_SESSION['password'] = $pswrd;
                    $_SESSION['email'] = $email;

                    if (isset($_POST['rmb'])) {
                        setcookie("currentuser", $email . "," . $pswrd);
                    }

                    header("Location: ../paginaIniziale.html?name=$name");
                    exit();

                } else {

                    // NESSUNA CORRISPONDENZA CON LA PASSWORD
                    header("Location: ./retry.html");
                    exit();

                }
            
            } else {

                // NON HO TROVATO L'INDIRIZZO EMAIL NEL DATABASE
                header("Location: ../registrazione/pre_registration.html");
                exit();
            }

        }

        /* Alla fine chiudiamo la connessione. */
        pg_close($dbconn);

    ?>

</body>
</html>