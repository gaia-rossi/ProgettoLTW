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

    
    <link rel="stylesheet" href="./pagin.css">

    <title>Evento</title>
    
    <style>
        .card-b {
            margin-right: 20px;
        }
    </style>

</head>
<body>

    <?php
        if(isset($_GET["evento"])){
            $_SESSION["iscrizioneevento"] = $_GET["evento"];
        }
        if(isset($_GET["data"])){
            $_SESSION["iscrizionedata"] = $_GET["data"];
        }
        
        
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

            //carico tutti i post
            $("#zonapost").load("./post/mostraPost.php",
                function(responseTxt, statusTxt, xhr){
                        if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
        });  
    </script>   

<nav class="navbar navbar-expand-lg bg-light navbar-dark bg-dark"> 
    <div class="container-fluid">
      <a class="navbar-brand" href="#">WEvent</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Pagina Evento </a>
          </li>          
        </ul>
          <form action="#" method="POST" class="d-flex" role="search" name="searchBar">
            <input class="form-control me-2" name="bar" id="bar" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" id="barButton" type="submit"><img src="./icons/search.svg"  class="format-white"></button>
          </form>
        
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./area_riservata/area_riservata.html">
              <img src="./icons/person-fill.svg"  class="format-white"> Area Riservata
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="./paginaIniziale.html">
              <img src="./icons/backspace-fill.svg" class="format-white"> Indietro
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-9">
        <!-- HEADER DELLA PAGINA -->
        <div class="card text-bg-dark card-b">
            <div id="fotoCategoria"></div>
                <div class="card-img-overlay">
                    <h5 class="card-title" id="nomeEvento">
                        <?php echo $_SESSION["iscrizioneevento"];?>
                    </h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>
                        <?php echo "L'evento si terrà in data: " . $_SESSION["iscrizionedata"];?>
                    </small></p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <!-- CARD PER PUBBLICARE CONTENUTI-->
            <div class="card card-b">
                <div class="card-header">
                Partecipa alla conversazione!
                </div>
                <div class="card-body">
                    <form action="./post/pubblicaPost.php" method="post" name="pubblicaPost">
                        <textarea name="contenuto" id="contenuto" class="form-control" size="590" maxlength="500" placeholder="..." required></textarea>
                        <button type="submit" class="btn btn-outline-success">Pubblica</button>
                        <button type="reset" class="btn btn-outline-warning">Reset </button>
                    </form>
                </div>
                <!--<div class="card-footer text-muted">
                    2 days ago
                </div>-->
            </div>

            <div class="container">
                <button class="btn btn-success btn-lg" id="subButton">
                <img src="./icons/bookmarks-fill.svg"  class="format-white"> Iscriviti!
                </button>
            </div>

                    
            <div id="roba">
                ...
            </div>
        </div>
    </div>
    
</div>
    
    <div class="container">
        <h3>Tutti i post </h3>
        <div class="container" id="zonapost">
            
        </div>
    </div>
    
</body>
</html>