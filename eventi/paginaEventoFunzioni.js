function setupAreaRiservata(){
    $.ajax({
        async:true,
        type: "POST",
        url: '../area_riservata/ottieniNome.php',
        dataType: 'json',
        success: function(result){
          var x = result["nomeUtente"];
          document.getElementById("arearis").innerText = x;   
        },
        error: function(){
          alert("Chiamata fallita per nascondere evento!!!");
        }
    });
}

function inizializzazioneCopertina(){
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
}

function gestioneIscrizioni(){
    $("#subButton").click(function(){
        var t = $("#subButton").text();
        t = t.trim();
        if(t == "Iscriviti!"){
            $("#roba").load("../eventi/iscrizioneEvento.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
            document.getElementById("subButton").innerText = "Disiscriviti!";  
        }else{
            $("#roba").load("../eventi/annullaiscrizioneEvento.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
            });
            $("#cardPost").hide();
            $("#zonaPost").hide();
            document.getElementById("subButton").innerText = "Iscriviti!";
        }
    });
}

function gestionePost(){
    $.ajax({
        async:true,
        type: "POST",
        url: './nascondiTasti.php',
        dataType: 'json',
        success: function(result){
            var res = result["iscritto"];
            if(res == 0){
                $("#cardPost").hide();
                $("#zonaPost").hide();
            }else{
                //document.getElementById("subButton").disabled = true;
                document.getElementById("subButton").innerText = "Disiscriviti!";
            }
        },
        error: function(){
          alert("Chiamata fallita per nascondere evento!!!");
        }
    });
}

function loadPost(){
    $("#zonapost").load("../post/mostraPost.php",
        function(responseTxt, statusTxt, xhr){
            if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
    }); 
}

function inizializza(){
    $(document).ready(function(){
        setupAreaRiservata();
        inizializzazioneCopertina();
        gestioneIscrizioni();
        gestionePost();
        loadPost();       
    });
    
}