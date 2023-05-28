function pwd_length() {

    const elem = document.getElementById("pswd-new");
    return elem.value.length >= 8;

}

function check_pass() {

    if (!pwd_length()) {
        alert("La nuova password deve avere almeno 8 caratteri!");
        return false;
    }

    return true;

}