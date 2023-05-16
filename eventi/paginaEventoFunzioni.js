function inizializza(){
    $(document).ready(function(){
        $.ajax({
            async:true,
            type: "POST",
            url: './infoEvento.php',
            dataType: 'json',
            success: function(result){
                var nomee = result['nomee'];
                var datae = result['datae'];
                var categoria =result['categoria'];
                var infoevento=result['info'];
                var organizzatore=result['organizzatore'];
                document.getElementById("nomeEvento").innerHTML = nomee;
                document.getElementById("dataEvento").innerHTML = datae;
                document.getElementById("infoEvento").innerHTML = infoevento;
                document.getElementById("organizzatore").innerHTML = organizzatore;

                
                document.getElementById("catEvento").innerHTML = categoria;
                document.getElementById("fotoCategoria").innerHTML = "<img src='../icons/" + categoria + ".jpg' class='card-img' alt='$categoria'>"
            },
            error: function(){
              alert("Chiamata fallita per nascondere evento!!!");
            }
        });

         // jquery per tasto iscrizioni
         /*$("#subButton").click(function(){
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
        });*/
    });
}