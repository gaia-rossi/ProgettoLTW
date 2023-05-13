<?php
$mail = "";
$pass = "";

if(isset($_COOKIE["currentuser"])){
    $pieces = explode(",", $_COOKIE["currentuser"]);
    $mail = $pieces[0];
    $pass = $pieces[1];
}
?>