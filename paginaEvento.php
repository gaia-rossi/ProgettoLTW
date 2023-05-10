<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css" />
    <script defer src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="jquery-3.6.0.js"></script>

    <title>Evento</title>
    
    <style>
        .card-b {
            margin-right: 20px;
        }
    </style>

</head>
<body>

    <?php
        $_SESSION["iscrizioneevento"] = $_GET["evento"];
        $_SESSION["iscrizionedata"] = $_GET["data"];
    ?>
    
    <script>
        $(document).ready(function(){
            // jquery per tasto iscrizioni
            $("#subButton").click(function(){
                $("#roba").load("./eventi/iscrizioneEvento.php",
                    function(responseTxt, statusTxt, xhr){
                        if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
                    });
            });

            //richiesta per caricare l'immagine correttamente
            $("#fotoCategoria").load("./eventi/sfondoEvento.php",
                function(responseTxt, statusTxt, xhr){
                        if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
        });  
    </script>   

<div class="container-fluid">
    
    <div class="card-group">
        <!-- HEADER DELLA PAGINA -->
        <div class="card text-bg-dark card-b">
            <div id="fotoCategoria"></div>
            <div class="card-img-overlay">
                <h5 class="card-title" id="nomeEvento">
                    <?php echo $_GET["evento"];?>
                </h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small>
                    <?php echo "L'evento si terrà in data: " . $_GET["data"];?>
                </small></p>
            </div>
        </div>

            <!-- CARD PER PUBBLICARE CONTENUTI-->
            <div class="card card-b">
                <div class="card-header">
                Partecipa alla conversazione!
                </div>
                <div class="card-body">
                <textarea name="infoEvento" id="infoEvento" class="form-control myinputs" size="140" maxlength="140" placeholder="..."></textarea>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>

        </div>
        
    </div>

    <div class="container">
        <button class="btn btn-success btn-lg float-end" id="subButton">
        <img src="./icons/bookmarks-fill.svg"  class="format-white"> Iscriviti!
        </button>
    </div>

    <div id="roba">
        ...
    </div>
    
</body>
</html>