<?php
    session_start();

    $utente = $_SESSION["nome"];

    $res = array('nomeUtente'=>$utente);

    header('Content-type: application/json');
    echo json_encode($res);

?>