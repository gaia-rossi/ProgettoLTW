<!-- CONTROLLO SE LA CONNESSIONE SIA DI TIPO POST -->
<?php

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /registrazione/registration.html");
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
    <title>PHP Sign-up</title>
</head>
<body>
    
    <?php

        // SE HO UNA CONNESSIONE CON IL DATABASE
        if ($dbconn) {

            // Email inserita
            $email = $_POST['insert_email'];
            // CONTROLLO SE L'EMAIL ESISTE GIA' NEL DATABASE
            $query1 = "SELECT * FROM utente WHERE email=$1";
            $result = pg_query_params($dbconn, $query1, array($email));
            
            if ($line = pg_fetch_array($result, null)) {

                // L'EMAIL E' GIA' PRESENTE NEL DATABASE, L'UTENTE NON SI DEVE REGISTRARE NUOVAMENTE
                echo "L'indirizzo Email è già in uso! Clicca 
                    <a href=../login/login.html>qui</a> per accedere, altrimenti
                    usa un altro indirizzo.";
            
            } else {

                // NON HO TROVATO L'INDIRIZZO EMAIL NEL DATABASE, L'UTENTE SI REGISTRA
                $nome = $_POST["insert_name"];
                $cognome = $_POST["insert_lastname"];
                $pswrd = password_hash($_POST["insert_pswrd"], PASSWORD_BCRYPT);
                $citta = $_POST["insert_city"];

                // QUERY PER INSERIRE LA NUOVA TUPLA NEL DATABASE
                $query2 = "INSERT INTO utente
                    (nome, cognome, email, pswrd, citta)
                    VALUES ($1,$2,$3,$4,$5)";
                $result = pg_query_params($dbconn, $query2, array(
                    $nome, $cognome, $email, $pswrd, $citta
                ));

                // TUPLA INSERITA
                if ($result) {
                    echo "<h1>La registrazione è andata a buon fine!</h1><br>";
                    echo "<a href=../login/login.html> Clicca qui </a> per accedere!";
                } else {
                    die("La registrazione non è andata a buon fine. Prova di nuovo!");
                }

            }

        }

        /* Alla fine chiudiamo la connessione. */
        pg_close($dbconn);

    ?>

</body>
</html>