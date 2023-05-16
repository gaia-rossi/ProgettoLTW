<?php
    session_start();
?>
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
    <title>Lista Eventi</title>
    <style>
        .card-b {
            min-height: 300px;
            min-width: 300px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-2 " style="overflow-y:scroll; overflow-y:auto;">
        <div class="d-flex flex-row flex-nowrap">
    <?php
        if($dbconn){
            $utente = $_SESSION["email"];
            $query = "SELECT * from iscritti where email=$1";
            $result = pg_query_params($dbconn, $query, array($utente));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            while($line != false){
                $nome=$line["nomee"];
                $data=$line["datae"];
                $query2 = "SELECT * from evento where nome=$1 and datae=$2";
                $result2 = pg_query_params($dbconn, $query2, array($nome, $data));
                $line2=pg_fetch_array($result2, null, PGSQL_ASSOC);
                $categoria = $line2["categoria"];
                echo"<div class='card card-b' style='width: 18rem;'>";
                echo"  <img class='card-img-top' src='./icons/$categoria.jpg' alt='Card image cap'>";
                echo"  <div class='card-body'>";
                echo"       <h5 class='card-title'>$nome</h5>";
                echo"       <p class='card-text'>L'evento si terrà in data: $data </p>";
                echo"       <a href='eventi\sessione.php?evento=$nome&data=$data' class='btn btn-primary'>Vai all'evento</a>";                        
                echo"   </div>";
                echo"</div>";
                $line=pg_fetch_array($result, null, PGSQL_ASSOC); 
            } 
            pg_close($dbconn);
        }
    ?>
        </div>
    </div>
</body>
</html>