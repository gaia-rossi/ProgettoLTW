<?php
    session_start();
    $dbconn = pg_connect("host=localhost user=postgres password=1234 port=5432 dbname=WEvent") 
    or die('Could not connect: ' . pg_last_error());
?>

<?php
    if($dbconn){
        $nome = $_SESSION["iscrizioneevento"];
        $data = $_SESSION["iscrizionedata"];
        $query = "SELECT * from evento where nome=$1 and datae=$2";
        $result = pg_query_params($dbconn, $query, array($nome, $data));
        $line=pg_fetch_array($result, null, PGSQL_ASSOC);
        if($line != false){
            //salvo in un JSON il nome dell'evento, la data, la categoria, le info e l'organizzatore
            $categoria = $line["categoria"];
            $info = $line["infoevento"];
            $organizzatore = $line["organizzatore"];
            //echo "<img src='../icons/$categoria.jpg' class='card-img' alt='$categoria'>";
            $res = array('nomee'=>$nome, 'datae'=>$data, 'categoria'=>$categoria, 'info'=>$info, 'organizzatore'=>$organizzatore);

            header('Content-type: application/json');
            echo json_encode($res);
        } 
        pg_close($dbconn);
    }
?>