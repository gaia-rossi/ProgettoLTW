<?php
    session_start();

    if(isset($_GET["evento"])){
        $_SESSION["iscrizioneevento"] = $_GET["evento"];
    }
    if(isset($_GET["data"])){
        $_SESSION["iscrizionedata"] = $_GET["data"];
    }

    header("Location: ./paginaEvento.html");
    exit();
?>