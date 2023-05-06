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
    
</head>
<body>
    <script>
        $(document).ready(function(){
            $("#subButton").click(function(){
                $("#roba").load("./eventi/iscrizioneEvento.php",
                function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
                });
            });
        });  
    </script>

    <?php
        $_SESSION["iscrizioneevento"] = $_GET["evento"];
        $_SESSION["iscrizionedata"] = $_GET["data"];
        echo "<h1>" . $_GET["evento"]. "</h1>";
        echo "<br>";
        echo "<h3> Data Evento " . $_GET["data"] . "</h3>";
    ?>
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