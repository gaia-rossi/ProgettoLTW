<!-- CONTROLLO SE LA CONNESSIONE SIA DI TIPO POST -->
<?php

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: /registrazione/registration.html");
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
                $pswrd = password_hash($_POST["insert_pswrd"], PASSWORD_BCRYPT);
                $regione = $_POST["insert_region"];
                $citta = $_POST["insert_city"];
                $org = 0;
                if (isset($_POST["org"])) {
                    $org = 1;
                }
                $header = "../pictures/outrageous_orange.jpg";
                $pfpic = "../avatars/user.png";

                // QUERY PER INSERIRE LA NUOVA TUPLA NEL DATABASE
                $query2 = "INSERT INTO utente
                    (nome, email, regione, pswrd, citta, organizer, head, pfpic)
                    VALUES ($1,$2,$3,$4,$5,$6,$7,$8)";
                $result = pg_query_params($dbconn, $query2, array(
                    $nome, $email, $regione, $pswrd, $citta, $org, $header, $pfpic
                ));

                // TUPLA INSERITA
                if ($result) {
                    header("Location: ../login/pre_login.html");
                    exit();
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