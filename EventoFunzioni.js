function inizializzaPagina(){
    //jquery e ajax
    $(document).ready(function(){
        $("#nomeEvento").load("./paginaEvento.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });
    });
    return true;
}