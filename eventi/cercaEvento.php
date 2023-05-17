<?php 
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    <script defer src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery-3.6.0.js"></script>
    <title>Ricerca Eventi</title>
    <style>
        .card-b {
            min-height: 300px;
            min-width: 300px;
            margin-right: 5px;
        }
    </style>

</head>
<body>
    <!-- inclusione navbar-->
    <?php include "../navbar.html";?>
    <?php
        $r = $_POST["bar"];
        echo "<h3> Ecco gli eventi che contengono '$r' nel titolo</h3></br>"; 
    ?>

    <div class="container-fluid py-2 " style="overflow-y:scroll; overflow-y:auto;">
        <div class="d-flex flex-row flex-nowrap">
    <?php
        if($dbconn){
            $ricerca = '%'. $r . '%';
            $query = "SELECT * from evento where nome like $1";
            $result = pg_query_params($dbconn, $query, array($ricerca));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            while($line != false){
                $nome=$line["nome"];
                $data=$line["datae"];
                $categoria = $line["categoria"];
                echo"<div class='card card-b' style='width: 18rem;'>";
                echo"  <img class='card-img-top' src='../icons/$categoria.jpg' alt='Card image cap'>";
                echo"  <div class='card-body'>";
                echo"       <h5 class='card-title'>$nome</h5>";
                echo"       <p class='card-text'>L'evento si terrà in data: $data </p>";
                echo"       <a href='./paginaEvento.php?evento=$nome&data=$data' class='btn btn-primary'>Vai all'evento</a>";                        
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