function check_form() {

    if (check_name()) {

        if (check_lastname()) {

            if (check_mail()) {

                if (check_pswrd()) {

                    if (check_city()) {

                        var remember = document.getElementById("rmbr").checked;
                        if (remember) {
                            window.alert("Hai scelto di essere ricordato per i prossimi accessi.");
                        } else {
                            window.alert("Hai scelto di non essere ricordato per i prossimi accessi");
                        }
                        return true;

                    } else {

                        alert("Devi selezionare una città di residenza!");
                        return false;

                    }

                } else {

                    alert("La password è obbligatoria e le due password devono corrispondere!");
                    return false;

                }
            
            } else {

                alert("Devi inserire una mail!");
                return false;

            }

        } else {

            alert("Devi inserire il cognome!");
            return false;

        }

    } else {

        alert("Devi inserire il nome!");
        return false;

    }

}

function check_name() {
    return (document.getElementById("name-input").value != "");
}

function check_lastname() {
    return (document.getElementById("lastname-input").value != "");
}

function check_mail() {
    return (document.getElementById("mail-input").value != "");
}

function check_pswrd() {
    return ((document.getElementById("pswd-input").value != "")
        &&(document.getElementById("pswd-input").value == document.getElementById("pswd-confirm").value))
}

function check_city() {
    return (document.getElementById("city-input").value != "");
}