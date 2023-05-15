function inizializza(){
    $(document).ready(function(){
         // jquery per tasto iscrizioni
         $("#subButton").click(function(){
            $("#roba").load("../eventi/iscrizioneEvento.php",
                function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
                });
        });

        //richiesta per caricare l'immagine correttamente
        $("#fotoCategoria").load("../eventi/sfondoEvento.php",
            function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });

        //carico tutti i post
        $("#zonapost").load("../post/mostraPost.php",
            function(responseTxt, statusTxt, xhr){
                    if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });
    });
}