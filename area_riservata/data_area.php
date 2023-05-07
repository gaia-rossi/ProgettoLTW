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
    <title>Area Riservata</title>
</head>
<body>

    <div class='card mt-2 mb-2'>

    <?php

        if($dbconn){

            $mail = $_SESSION['email'];
            $query = "SELECT * from utente where email=$1";
            $result = pg_query_params($dbconn, $query, array($mail));

            $line=pg_fetch_array($result, null, PGSQL_ASSOC);

            if ($line != false) {

                $nome=$line["nome"];
                $citta=$line["citta"];
                $regione=$line["regione"];

                echo"   <hr>";
                echo"   <div class='row'>";
                echo"       <div class='col-sm-3'>";
                echo"           <h5>Nome Utente</h5>";
                echo"       </div>";
                echo"       <div class='col-sm-9'>";
                echo"           $nome";
                echo"       </div>";
                echo"   </div>";
                echo"   <hr>";

                echo"   <div class='row'>";
                echo"       <div class='col-sm-3'>";
                echo"           <h5>Email</h5>";
                echo"       </div>";
                echo"       <div class='col-sm-9'>";
                echo"           $mail";
                echo"       </div>";
                echo"   </div>";
                echo"   <hr>";

                echo"   <div class='row'>";
                echo"       <div class='col-sm-3'>";
                echo"           <h5>Password</h5>";
                echo"       </div>";
                echo"       <div class='col-sm-9'>";
                echo"           *****";
                echo"       </div>";
                echo"   </div>";
                echo"   <hr>";

                echo"   <div class='row'>";
                echo"       <div class='col-sm-3'>";
                echo"           <h5>Regione</h5>";
                echo"       </div>";
                echo"       <div class='col-sm-9'>";
                echo"           $regione";
                echo"       </div>";
                echo"   </div>";
                echo"   <hr>";

                echo"   <div class='row'>";
                echo"       <div class='col-sm-3'>";
                echo"           <h5>Città</h5>";
                echo"       </div>";
                echo"       <div class='col-sm-9'>";
                echo"           $citta";
                echo"       </div>";
                echo"   </div>";
                echo"   <hr>";

            } 

            pg_close($dbconn);

        }

    ?>

    </div>

</body>
</html>