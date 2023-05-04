<?php
    if($_SERVER["REQUEST_METHOD"] != "POST"){
        header("Location: /");
    }else {
        $dbconn = pg_connect("host=localhost user=postgres password=1234 
        port=5432 dbname=WEvent") or die('Could not connect: ' . pg_last_error());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($dbconn){
            $nomeEvento = $_POST["nomeEvento"];
            $dataEvento = $_POST["dataEvento"];
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
    ?>
</body>
</html>