function loadIscrizioni(){
  $("#zonaiscrizioni").load("./eventi/listaiscrittiEventi.php",
      function(responseTxt, statusTxt, xhr){
        if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
  });
}

function loadEventi(){
  $("#zonaeventi").load("./eventi/listaEventi.php",
      function(responseTxt, statusTxt, xhr){
        if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
  });
}

function loadBenvenuto(){
  $("#zonadibenvenuto").load("./paginaIniziale/inizializzazioneSession.php",
    function(responseTxt, statusTxt, xhr){
      if(statusTxt == "error") alert("Errore" + xhr.status + ": " + xhr.statusText+ " " + this.innerHTML);
    });
}

function selezionePerCategoria(){
  $(".dropdown-item").click(function(){
    var x = this.id;
    $.ajax({
      async:true,
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
      async:true,
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
}

function setupOrganizzatore(){
  $.ajax({
    async:true,
    type: "POST",
    url: './paginaIniziale/organizzatore.php',
    dataType: 'json',
    success: function(result){
      var j = result['organizzatore'];
      if(j == 0){
        $("#aggiungi").hide();
      }       
    },
    error: function(){
      alert("Chiamata fallita per nascondere evento!!!");
    }
  });
}

function setupAreaRiservata(){
  $.ajax({
    async:true,
    type: "POST",
    url: './area_riservata/ottieniNome.php',
    dataType: 'json',
    success: function(result){
      var x = result["nomeUtente"];
      document.getElementById("arearis").innerHTML = x;   
    },
    error: function(){
      alert("Chiamata fallita per nascondere evento!!!");
    }
  });
}

function autocompleta(){
  $.ajax({
    async:true,
    type: "POST",
    url: './nomieventi.php',
    dataType: 'json',
    success: function(result){
      var x = result["risultato"];
      //todo  
    },
    error: function(){
      alert("Chiamata fallita per nascondere evento!!!");
    }
  });
}

function inizializza(){
    //inizializzazione local storage
    var x = JSON.parse(localStorage.utente);
    var e = x["email"];
    document.getElementById("orID").value = e;

    //jquery e ajax
    $(document).ready(function(){
      loadIscrizioni();
      loadEventi();
      loadBenvenuto();  
      selezionePerCategoria();
      setupOrganizzatore();
      setupAreaRiservata();
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
  return true; 
}

function verificaEvento(){
  //controllo che la data dell'evento sia posteriore o uguale alla giornata odierna
  var d = document.getElementById("dataEvento").value;
  var ds = d.toString();
  var arr = ds.split("-");
  
  var currd = new Date();
  var day = currd.getDate();
  var month = currd.getMonth()+1;
  var year = currd.getFullYear();

  if(arr[0]>=year){
    if(arr[1]>=month){
      if(arr[2]>=day){
        return true;
      }
    }
  }
  alert("non puoi inserire una data passata!");
  return false;
}
