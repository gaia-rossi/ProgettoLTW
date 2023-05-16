<?php
    session_start();
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>
<?php
    if($dbconn){
        $utente = $_SESSION["email"];
        $nome = $_SESSION["iscrizioneevento"];
        $data = $_SESSION["iscrizionedata"];
        $query = "SELECT * from iscritti where email=$1 and nomee=$2 and datae=$3";
        $result = pg_query_params($dbconn, $query, array($utente, $nome, $data));
        $line=pg_fetch_array($result, null, PGSQL_ASSOC);
        if($line != false){
            $valore = 1;           
        }else {
            $valore = 0; 
        }

        $res = array('iscritto'=>$valore); 
        header('Content-type: application/json');
        echo json_encode($res);
        pg_close($dbconn);
    }
?>