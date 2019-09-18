LoadDB();
SaveDB();
verifique();
 
 function login(){

    

    var nome = document.getElementById("user").value;
    let senha = document.getElementById("pass").value;
    console.log(database.pessoas[0].nome)
    for (i=0 ; i < database.pessoas.length; i++)
    if(nome == database.pessoas[i].nome & senha == database.pessoas[i].senha){
        console.log("vc esta logado", estouLogado())
        database.pessoas[i].online = true;
        SaveDB();
        window.location.replace("index.html");
        break;
        
    } else {

        achou = 1
    }

    if(achou == 1){
alert("ERRO VC NAO ESTA CADASTRADO")

    }
 }











