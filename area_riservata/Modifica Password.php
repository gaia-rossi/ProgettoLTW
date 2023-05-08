<?php
    // Start della sessione
    session_start();
?>

<!-- NUOVA PASSWORD -->
<?php 
    $psw = $_SESSION['password']; 
?>

<label for="pswd-new" id="lb_pass">Nuova Password</label>
<input name="new_pswrd" type="password" class="form-control" id="pswd-new" value="<?php echo'$psw' ?>" readonly required>
<small>Inserisci '*****' o lascia il valore corrente per confermare la password attuale.</small>
<br>
<small>Clicca la matita per modificare il campo.</small>