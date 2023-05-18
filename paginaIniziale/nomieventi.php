<?php
    session_start();
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<?php

    if($dbconn){
        $query = "SELECT distinct nome from evento";
        $result = pg_query($dbconn, $query);
        $line=pg_fetch_array($result, null, PGSQL_ASSOC);
        $res= array();
        while($line != false){
            $evento = $line["nome"];

            array_push($res, $evento);
            $line=pg_fetch_array($result, null, PGSQL_ASSOC);
            
        }

        $f = array("risultato" => $res);
        header('Content-type: application/json');
        echo json_encode($f);

        pg_close($dbconn);
    }
?>