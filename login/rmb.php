<?php
    session_start();
?>

<?php
$mail = "";
$pass = "";


if(isset($_COOKIE["currentuser"])){
    $pieces = explode(",", $_COOKIE["currentuser"]);
    $mail = $pieces[0];
    $crypt = $pieces[1];
    $pass = base64_decode($crypt);
}


$res = array('mail'=>$mail, 'pass'=>$pass);

header('Content-type: application/json');
echo json_encode($res);

?>