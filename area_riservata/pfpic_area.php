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
</head>
<body>
    <?php
        if($dbconn){
            $tipo = "pfpic";

            $query = "SELECT * from pictures WHERE tipo=$1";
            $result = pg_query_params($dbconn, $query, array($tipo));
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);

            while($line != false){
                $img = $line["img"];

                echo"<label>";
                echo"   <input type='radio' name='pfpicgroup' value='$img'>";
                echo"   <img class='circle' src='$img' style='width: 100px; margin: 10px;'>";
                echo"</label>";

                $line=pg_fetch_array($result, null, PGSQL_ASSOC); 
            } 
            pg_close($dbconn);
        }
    ?>
</body>
</html>