//   PESQUISAR CLICK 
var focused = false;
// focused
$("#pesquisar").focus(function()
{
    $("#results").css("display", "block" );

    focused = true;
    console.log("Focado");
});


$(document).click(function(event) { 
    if(!$(event.target).closest('#results').length) {

        if(!focused) {
            $("#results").css("display", "none" );
        }
    }        
});

// focusout
$("#pesquisar").focusout(function()
{
    focused = false;
    console.log("Desfocado");
});


// pesquisar key up

$("#pesquisar").keyup(function(e){

    if(e.key == "Backspace")
    {
        var pLen = $("#pesquisar").val().length;

        if(pLen < 1)
        {
            $("#results").empty();
        }
    
        return;
    }

    $("#results").empty();

    console.log(e.key);

    var tValue = $("#pesquisar").val();
 

    var len = db.dados.length;


     // interesses
     var interesses = `<div class="sub-menuPesquisa"><center><h3>Interesses/Pessoas</h3></center></div>`;
     $("#results").append(interesses);

    for(var i = 0; i < len; i++)
    {
        if(db.dados[i].nome.search(tValue) >= 0)
        {
            var nome = db.dados[i].nome;
            var div = `<div class="op-menu"> <a href="?profile=${nome}">${nome}</a><br><br></div>` ;
            $("#results").append(div);
        }
    }
    
    // grupos
    var gruposLen = db.grupos[0].tipos.length;

    var grupos = `<div class="sub-menuPesquisa"><center><h3>Grupos</h3></center></div>`;
    $("#results").append(grupos);


    for(var j = 0; j < gruposLen; j++)
    {
        if(db.grupos[0].tipos[j].search(tValue) >= 0)
        {
            var nome = db.grupos[0].tipos[j];
            var div = `<div class="op-menu"> <a  href="?group=${nome}">${nome}</a><br><br></div>` ;
            $("#results").append(div);
        }
    }

});






//   $("#pesquisar").keyup(function(e) {
//       var q = $("#pesquisar").val();
//               $("#results").empty();
//       $.getJSON("js/dados.js", function(db){
            
//           $.each(db, function(_i, item) {
//           aux = item.Tag.trim().toLowerCase().split(",")
//           console.log($("#pesquisar").val().trim().toLowerCase(),aux,aux.indexOf($("#pesquisar").val().trim().toLowerCase()))
//           if( aux.indexOf($("#pesquisar").val().trim().toLowerCase()) >= 0 )
//           {
//               console.log("Encontrou")
//               $("#results").append("<div>" + item.dados.nome + "<br><br></div>");
//           }
              
//       });
//    });

// });