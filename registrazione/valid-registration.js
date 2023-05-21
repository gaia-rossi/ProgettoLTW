function check_name() {
    const elem = document.getElementById("name-input");
    console.log(elem.value);
    return (elem.value != "");
}

function check_mail() {
    const elem = document.getElementById("mail-input");
    console.log(elem.value);
    return (elem.value != "");
}

function check_pswrd() {
    const elem = document.getElementById("pswd-input");
    const confirm = document.getElementById("pswd-confirm");
    console.log(elem.value);
    console.log(confirm.value);
    return (elem.value != "" && (elem.value == confirm.value));
}

function check_region() {
    const elem = document.getElementById("region-input");
    console.log(elem.value);
    return (elem.value != "");
}

function check_city() {
    const elem = document.getElementById("city-input");
    console.log(elem.value);
    return (elem.value != "");
}


function check_form() {

    if (!check_name()) {
        alert("Devi inserire il nome!");
        return false;
    }

    if (!check_mail()) {
        alert("Devi inserire una mail!");
        return false;
    }

    if (!check_pswrd()) {
        alert("La password è obbligatoria e le due password devono corrispondere!");
        return false;
    }

    if (!check_region()) {
        alert("Devi selezionare una regione di residenza!");
        return false;
    }

    if (!check_city()) {
        alert("Devi inserire una città di residenza!");
        return false;
    }

    /*
    var remember = document.getElementById("rmbr").checked;
    if (remember) {
        window.alert("Hai scelto di essere ricordato per i prossimi accessi.");
    } else {
        window.alert("Hai scelto di non essere ricordato per i prossimi accessi");
    }
    */
    return true;
}