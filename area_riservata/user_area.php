<?php
    // Start della sessione
    session_start();
    $current_pass = $_SESSION["password"];
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

    <!-- UTILIZZO JQUERY -->
    <script>
        $(document).ready(function(){
            $("#zonaDinamicaHeader").load("./header_area.php",
                function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
            $("#zonaDinamicaPfPic").load("./pfpic_area.php",
                function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
        });
        $("#modifica").on({
            click: function(){
                $("#passDinamica").fadeToggle();
            }
        });
    </script>

    <!-- UTILIZZO AJAX 
    <script>
        document.getElementById("modifica").onclick = caricaDocumento;

        function caricaDocumento(e) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = gestisciResponse;
            httpRequest.open("GET", e.target.innerHTML + ".php", true);
            httpRequest.send();
        }

        function gestisciResponse(e) {
            if (e.target.readyState == 4 && e.target.status == 200) {
                document.getElementById("passDinamica").innerHTML
                = e.target.responseText;
            }
        }
    </script>
    -->

</head>
<body>

        <?php

            if($dbconn){

                $mail = $_SESSION['email'];
                $query = "SELECT * from utente where email=$1";
                $result = pg_query_params($dbconn, $query, array($mail));

                $line=pg_fetch_array($result, null, PGSQL_ASSOC);

                if ($line != false) {

                    $nome=$line["nome"];
                    $regione=$line["regione"];
                    $citta=$line["citta"];

                    $head=$line["head"];
                    $pfpic=$line["pfpic"];

                    $org=$line["organizer"];
                    $ruolo = "Utente Semplice";
                    if ($org == 1) $ruolo = "Organizzatore";
                }

            }
        
        ?>

        <div class="mt-2 upheader align-items-center">
            <a data-bs-target="#headerModal" data-bs-toggle="modal" href="#headerModal">
                <img src="<?php echo"$head" ?>" class="img-fluid justify-content-center">
            </a>
        </div>

        <!-- HEADER MODAL -->
        <div class="modal fade" id="headerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aggiornamento Header</h5>
                    </div>
                    <div class="modal-body">
                        <form action="updateHeader.php" method="post" name="modificaHeader">
                            <!-- Carico dinamicamente gli header salvati. -->
                            <div class="container d-flex text-center">    
                                <div id="zonaDinamicaHeader">
                                    ...
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Salva Header</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="chiudi" type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile text-center">
            <a data-bs-target="#pfpicModal" data-bs-toggle="modal" href="#pfpicModal">
                <img src="<?php echo"$pfpic" ?>" class="rounded-circle" width="150">
            </a>    
        </div>

        <!-- PROFILE PIC MODAL -->
        <div class="modal fade" id="pfpicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aggiornamento Immagine del Profilo</h5>
                    </div>
                    <div class="modal-body">
                        <form action="updatePfPic.php" method="post" name="modificaPfPic">
                            <!-- Carico dinamicamente gli header salvati. -->
                            <div class="container d-flex text-center">    
                                <div id="zonaDinamicaPfPic">
                                    ...
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Salva Foto Profilo</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="chiudi" type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 text-center">
            <h4> <?php echo"$nome" ?> </h3>
            <p class="text-secondary mb-1"> <?php echo"$ruolo" ?> </p>
        </div>

        <!-- Button trigger modal -->
        <div class="text-center">
            <button type="button" class="btn btn-dark btn-lg mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#updateModal">
                Modifica Profilo
            </button>
        </div>

        <!-- NUOVA PASSWORD -->
        <div class="text-center mb-2" name="div_newpass">
            <button class="btn btn-outline-dark mb-2" id="modifica">Modifica Password</button>
            <form action="updatePassword.php" method="post" name="modificaPassword">
                <div id="passDinamica" class="form-group mb-1" style="display: none;">
                    <label for="pswd-new" id="lb_pass">Nuova Password</label>
                    <input name="new_pswrd" type="password" class="form-control mb-2" id="pswd-new" required>
                    <button type="submit" class="btn btn-success mb-2">Salva Modifica</button>
                </div>
            </form>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aggiornamento Dati</h5>
                    </div>
                    <div class="modal-body">
                        <form action="updateUser.php" method="post" name="modificaProfilo">
                            <!-- INSERIMENTO NOME UTENTE -->
                            <div class="form-group mb-1" name="div_name">
                                <label for="name-input">Nome utente</label>
                                <input type="text" name="insert_name" class="form-control" value="<?php echo"$nome" ?>" id="name-input" autofocus required>
                            </div>

                            <!-- INSERIMENTO EMAIL -->
                            <div class="form-group mb-1" name="div_mail">
                                <label for="mail-input">Indirizzo Email</label>
                                <input name="insert_email" type="email" class="form-control" id="mail-input"
                                    value="<?php echo"$mail" ?>" readonly disabled>
                            </div>

                            <!-- INSERIMENTO REGIONE E CITTÀ -->
                            <div class="form-group mb-1">
                                <label for="region-input">Regione di residenza</label>
                                <input type="text" name="insert_region" class="form-control" value="<?php echo"$regione" ?>" id="region-input" required>
                            </div>

                            <div class="form-group mb-1">
                                <label for="city-input">Città di residenza</label>
                                <input type="text" name="insert_city" class="form-control" value="<?php echo"$citta" ?>" id="city-input" required>
                            </div>

                            <!-- VECCHIA PASSWORD -->
                            <div class="form-group mb-1" name="div_pass">
                                <label for="pswd-input">Password</label>
                                <input name="insert_pswrd" type="password" class="form-control" id="pswd-input" 
                                    value="<?php echo"$current_pass" ?>" required readonly disabled>
                            </div>

                            <button type="submit" class="btn btn-success">Salva Modifiche</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="chiudi" type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>

        <?php

            pg_close($dbconn);

        ?>

</body>
</html>