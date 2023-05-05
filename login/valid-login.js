function check_box() {

    var remember = document.getElementById("rmbr").checked;
    if (remember) {
        window.alert("Hai scelto di essere ricordato per i prossimi accessi.");
    } else {
        window.alert("Hai scelto di non essere ricordato per i prossimi accessi");
    }
    
    inizializzaStorage();
    resetStorage();
    salvaUtente();
}

function inizializzaStorage(){
    if(typeof(localStorage.utente) == "Undefined"){
        localStorage.utente = "";
    }
}

function resetStorage(){
    localStorage.utente = "";
}

function salvaUtente(){
    //inserire controlli 
    var o = {email: document.login_form.insert_email.value};
    var n = JSON.stringify(o);
    alert(n);
    localStorage.utente = n;
    alert("inserito elemento!");
    return true;
}