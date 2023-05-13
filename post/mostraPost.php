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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    <script defer src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery-3.6.0.js"></script>

    <title>Lista post</title>
</head>
<body>
    <?php
        if($dbconn){
            $evento = $_SESSION["iscrizioneevento"];
            $data = $_SESSION["iscrizionedata"];
            //query per cercare tutti i post su quell'evento
            $query = "SELECT * from post where nomee=$1 and datae=$2";
            $result = pg_query_params($dbconn, $query, array($evento, $data));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            while($line != false){
                $utente =$line["autore"];
                $contenuto=$line["contenuto"];

                //query per cercare tutti i commenti a quel post
                $numerop=$line["numero"];
                $query2 = "SELECT * from commenti where numerop=$1";
                $result2 = pg_query_params($dbconn, $query2, array($numerop));
                $line2=pg_fetch_array($result, null, PGSQL_ASSOC);

                echo "<div class='card card-b'>";
                echo "  <div class='card-header'>";
                echo $utente;
                echo "  </div>";            
                echo "  <div class='card-body'>";
                echo $contenuto;
                echo "  </div>"; 
                echo "  <div class='card-footer text-muted'>";
                #finestra modale per commenti
                echo "      <a>visualizza i commenti<a>";
                #finestra modale per commentare
                echo "<button id='scrivic' class='btn btn-success btn-sm float-end' data-bs-target='#myModal' data-bs-toggle='modal'> Scrivi un commento
                        </button>";
                echo" <div id='myModal' class='modal fade' tabindex='-1'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>  <!-- contenuto della finestra modale-->
                                <div class='modal-header'> <!-- HEADER-->
                                    Scrivi un commento
                                    <button class='btn-close' data-bs-dismiss='modal'></button> <!--crocetta per chiudere-->
                                </div>
                                <div class=''modal-body'>
                                        <form action='./inserisciCommenti.php' method='post' name='pubblicaCommento'>
                                            <textarea name='contenuto' id='contenuto' class='form-control' size='250' maxlength='250' placeholder='...' required></textarea>
                                            <button type='submit' class='btn btn-outline-success'>Pubblica</button>
                                            <button type='reset' class='btn btn-outline-warning'>Reset </button>
                                        </form>
                                </div> <!--BODY-->
                                <div class='modal-footer'> <!--FOOTER-->  
                                        <button class='btn btn-danger' data-bs-dismiss='modal'>Chiudi</button>
                                </div>
                            </div>
                        </div>";
                echo "  </div>";
                echo "  </div>";
                echo "</div>";
                $line=pg_fetch_array($result, null, PGSQL_ASSOC); 
            }

            pg_close($dbconn);
        }
    ?>

    
</body>
</html>