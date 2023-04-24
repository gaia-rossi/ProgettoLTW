<?php 
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=provaEvento") 
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
    <title>Lista Eventi</title>
</head>
<body>
    <!--<div class="card-group">-->
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
        if($dbconn){
            $query = "SELECT * from evento where $1";
            $result = pg_query_params($dbconn, $query, array("true"));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            while($line != false){
                $nome=$line["nome"];
                $data=$line["datae"];
                //echo "<button> <a href='#'> $nome <a><br> $data</button>";
                echo"<div class='col'>";
                echo "  <div class='card' style='width: 18rem;'>";
                echo "      <img class='card-img-top' src='./bootstrap/assets/img/bootstrap-icons.png' alt='Card image cap'>";
                echo "      <div class='card-body'>";
                echo"           <h5 class='card-title'>$nome</h5>";
                echo"           <p class='card-text'>L'evento si terrà in data: $data </p>";
                echo"           <a href='#' class='btn btn-primary'>Go somewhere</a>";                        
                echo"       </div>";
                echo"   </div>";
                echo"</div>";       
                $line=pg_fetch_array($result, null, PGSQL_ASSOC); 
            } 
            pg_close($dbconn);
        }
    ?>
    </div>
</body>
</html>