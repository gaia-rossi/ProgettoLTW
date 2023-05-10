function inizializza(){
    //inizializzazione local storage
    var x = JSON.parse(localStorage.utente);
    var e = x["email"];
    document.getElementById("orID").value = e;

    //jquery e ajax
    $(document).ready(function(){
        $("#zonaiscrizioni").load("./eventi/listaiscrittiEventi.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });
        $("#zonaeventi").load("./eventi/listaEventi.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });
        $("#zonadibenvenuto").load("inizializzazioneSession.php",
            function(responseTxt, statusTxt, xhr){
                if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
        });
        $(".dropdown-item").click(function(){
          var x = this.id;
          $.ajax({
            type: "POST",
            url: './eventi/queryiscrittiEventi.php',
            data: {'categoria' : x},
            success: function(result){
              $("#zonaiscrizioni").html(result);
            },
            error: function(){
              alert("Chiamata fallita!!!");
            }
          });
    
          $.ajax({
            type: "POST",
            url: './eventi/querylistaEventi.php',
            data: {'categoria' : x},
            success: function(result){
              $("#zonaeventi").html(result);
            },
            error: function(){
              alert("Chiamata fallita!!!");
            }
          });
        });

        $.ajax({
          type: "POST",
          url: './organizzatore.php',
          dataType: 'json',
          success: function(result){
            var j = result['organizzatore'];
            alert(j);
            if(j == 0){
              $("#aggiungi").hide();
            }       
          },
          error: function(){
            alert("Chiamata fallita per nascondere evento!!!");
          }
        });
    });
    return true;
}

function stampaStorage(){    
    var j = JSON.parse(localStorage.utente);
    var res = new String("<h3> Stato attuale di local storage </h3>");
    res += JSON.stringify(j) + "<br />";
    document.getElementById("roba a caso").innerHTML = res;
    return true;
}

function verifica(){
    if(document.searchBar.bar.value== ""){
      alert("non hai inserito nessun evento da cercare!");
      return false;
    }   
  }
