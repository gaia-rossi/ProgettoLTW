<?php
    session_start();
?>
<?php 
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<?php
    if($dbconn){
        $utente = $_SESSION["email"];
        $query = "SELECT * from utente where email=$1";
        $result = pg_query_params($dbconn, $query, array($utente));
        $line=pg_fetch_array($result, null, PGSQL_ASSOC);
        if($line != false){
            $organizzatore = $line["organizer"];

            $res = array('organizzatore'=>$organizzatore);

            header('Content-type: application/json');
            echo json_encode($res);
        } 
        pg_close($dbconn);
    }
?>