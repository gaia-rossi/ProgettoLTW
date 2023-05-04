<?php 
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
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

    <!--utilizzo localStorage-->
    <script>
      function stampaStorage(){    
        var j = JSON.parse(localStorage.utente);
        var res = new String("<h3> Stato attuale di local storage </h3>");
        res += JSON.stringify(j) + "<br />";
        document.getElementById("roba a caso").innerHTML = res;
        return true;
      }
    </script>
</head>
<body>
    <?php
        echo "<h1>" . $_GET["evento"]. "</h1>";
        echo "<br>";
        echo "<h3> Data Evento " . $_GET["data"] . "</h3>";
        #print_r($_POST);
    ?>
    <div class="container">
        <button class="btn btn-success btn-lg float-end">
        <img src="./icons/bookmarks-fill.svg"  class="format-white"> Iscriviti!
        </button>
    </div>
    
    <div id="roba a caso" onclick="stampaStorage()">
        clicca
    </div>

    <!--
    <?php
        if($dbconn){
            $evento = $_GET["evento"];
            $data = $_GET["data"];

            $query = "SELECT * from evento where nome=$1 and dataE=$2";
            $result = pg_query_params($dbconn, $query, array($nomeEvento, $dataEvento));
            if($line=pg_fetch_array($result)){
                echo "L'evento è già stato creato! clicca <a href='./paginaIniziale.html'> QUI </a>
                    vedere tutti gli eventi"; //cambiare indirizzo
            } else {
                $categoria = $_POST["categoria"];
                $infoEvento = $_POST["infoEvento"];
                $organizzatore = $_POST["organizzatore"];
                $query2 = "INSERT INTO evento (nome, dataE, categoria, infoEvento, organizzatore)
                            VALUES ($1, $2, $3, $4, $5)";
                $result = pg_query_params($dbconn, $query2,array($nomeEvento, $dataEvento, $categoria, $infoEvento, $organizzatore));
                if($result){
                    echo "L'evento è stato inserito correttamente!<br>
                    clicca <a href='./paginaIniziale.html'> QUI </a> per vedere la lista degli eventi aggiornata";
                } else {
                    die("l'inserimento non è andato a buon fine. Prova di nuovo");
                }
        }
            pg_close($dbconn);
        }
    ?>-->
</body>
</html>