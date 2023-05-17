function ricordami(){

    $(document).ready(function(){

        $.ajax({
            async: true,
            type: "POST",
            url: './rmb.php',
            dataType: 'json',
            success: function(result){
                var mail = result["mail"];
                var pass = result["pass"];
                $("#mail-input").val(mail);
                $("#pswd-input").val(pass);
                //document.getElementById("mail-input").value = mail;
                //document.getElementById("pswd-input").value = pass;
            },
            error: function(){
              alert("Chiamata fallita per nascondere evento!!!");
            }
          });
    
    });
    return true;
}