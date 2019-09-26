var database = {
    "pessoas": 
    [
        {
            "id": 0,
            "senha": "vasco",
            "nome": "wallace barbosa",
            "setor/instituicao": 1,
            "email": "wallace-naruto@gmail.com",
            "online": false
        },
        {
            "id": 1,
            "senha": "123456",
            "nome": "andre murilo",
            "setor/instituicao": 0,
            "email": "andre92@academyclub.com",
            "online": true
        }
    ],

    "Setorinst": 
    [
        {
            "id": 0,
            "Nome": "Almoxarifado",
            "Unidade": 1
        },
        {
            "id": 1,
            "Nome": "Ambulatório",
            "Unidade": 1
        }

    ],

    "Unidades": 
    [
        {
            "id": 0,
            "nome": "Hospital São francisco unidade - Santa lucia",
            "endereço": "Rua Crúcis, 50 - Santa Lúcia, Belo Horizonte - MG, 30360-290"
        },
        {
            "id": 2,
            "nome": "Hospital São francisco unidade - Concórdia",
            "endereço": " R. Itamaracá, 535 - Concórdia, Belo Horizonte - MG, 31110-580"
        }
    ],

    "Protocolo":
    [
        {
            "id":1,
            "data": "21/09/2019",
            "titulo":"Coletar Assinatura",
            "remetente":{
                "nome": "wallace barbosa",
                "setor/instituicao": 0,
                "Endereço": ""
            },
            
            "destinatario":{
                "setor/instituicao": 1,
                "Endereço": ""
            },
            
            "status": "aberto"
        },
        {
            "id":2,
            "data": "21/09/2019",
            "titulo":"envio de formulario",
            "remetente":{
                "nome": "joao grilo",
                "setor/instituicao": 0,
                "descricao": ""
            },
            
            "destinatario":{
                "setor/instituicao": 1
            },
            "status": "fechado"
        },
        {
            "id":3,
            "data": "21/09/2019",
            "titulo":"Coleta de documento",
            "remetente":{
                "nome": "maria bonita",
                "setor/instituicao": 1,
                "descricao": ""
            },
            
            "destinatario":{
                "setor/instituicao": 1
            },
            "status": "aberto"
        }
    ]
};




var currentUser;

function userOn(){
    return currentUser;
}

function login(email, senha)
{
    for(var i = 0; i < database.pessoas.length; i++)
    {
        let pessoa = database.pessoas[i]; 
        if(pessoa.email == email && pessoa.senha == senha)
        {
            currentUser = pessoa;
            return true;
        }
    }
    return false;
}


function logout(){

    for(i=0; i < database.pessoas.length; i++) {
        currentUser = database.pessoas[i]

        if(currentUser.online == true){
            currentUser.online = false;
            SaveDB();
            break;
        } 

    }

}


function SaveDB()
{
    localStorage.setItem("db", JSON.stringify(database));
}

function LoadDB()
{
    if(localStorage.getItem("db"))
    {
        console.log("Carregando DB");
        database = JSON.parse(localStorage.getItem("db"));

        for(i=0;i < database.pessoas.length; i++){
            if(database.pessoas[i].online == true){
                currentUser = database.pessoas[i];
            }
        }
        
    } else {

        localStorage.setItem("db", JSON.stringify(database));
        for(i=0;i < database.pessoas.length; i++){
            if(database.pessoas[i].online == true){
                currentUser = database.pessoas[i];
            }
        }
    } 
}
LoadDB();


function cadastrarProtocolo(nome, dataCriacao, SetorInst, desc, SetorInst_Dest, titulo, telefone, email, enderecoRemetente) {
    let status = "aberto"
    let count;

    for (let i = 0; i < database.Protocolo.length; i++) {
        count = i;
    }

    let event = {
        "id": count,
        "data": dataCriacao,
        "titulo": titulo,
        "remetente": {
            "nome": nome,
            "telefone": telefone,
            "email": email,
            "setor/instituicao": SetorInst


        },

        "destinatario": {
            "setor/instituicao": SetorInst_Dest,
            "endereco": enderecoRemetente
        },
        "descricao": desc,
        "status": status
    };


    database.Protocolo.push(event);

    SaveDB();

    return true;
}

function usuarioInProtocolo(protocoloID, Setor_destID)
{
  
    for(var i = 0; i < database.Protocolo.length; i++)
    {
        let protocolo = database.Protocolo[i];
       
        if(protocolo.destinatario["setor/instituicao"] == protocoloID)
        {
            
            for(var j = 0; j < database.pessoas.length; j++)
            {
                if(database.pessoas[j]["setor/instituicao"] == Setor_destID)
                {
                    console.log("ok")
                    return true;
                }
            }
        }
    }

    return false;
}

function pegarHTMLProtocolo(protocolo, count)
{
    // let nome = pegarUsuario(protocolo.remetente.nome);  é assim queé para fazer com id
    let nome = protocolo.remetente.nome;
    let titulo = protocolo.titulo;
    let data = protocolo.data

    
    
    let SetorInst = pegarSetorInst(protocolo.remetente["setor/instituicao"])
    let status = protocolo.status;


    html = `
    <tr>
    <th scope="row">${count}</th>
    <td>${data}</td>
    <td>${titulo}</td>
    <td>${status}</td>
    <td>${SetorInst}</td>
    <td>${nome}</td>
  </tr>`

    return html;
}


function pegarProtocolosSetor()
{
    if(currentUser == null) {
        return null;
    }

    let protocolos = [];
    database = database = JSON.parse(localStorage.getItem("db"));

    for(var i = 0; i < database.Protocolo.length; i++)
    {
        let protocolo = database.Protocolo[i];

        if(usuarioInProtocolo(protocolo.destinatario["setor/instituicao"], currentUser["setor/instituicao"]))
        {
            protocolos.push(protocolo);
            
        }

    }

    return protocolos;
}

function pegarSetorInst(number){
    
    for(let i = 0 ; i < database.Setorinst.length;i++){
        
        if(database.Setorinst[i].id == number){
            let SetorInst = database.Setorinst[i].Nome
            
            return SetorInst;
        }
    }
}




function TableInsertProtocolos()
{
    let setores = pegarProtocolosSetor();

    let table = document.getElementById("table-protocolos");

    for(let i = 0; i < setores.length; i++)
    {
        let row = table.insertRow(i + 1);
        let setor = setores[i];

        row.insertCell(0).innerHTML = setor.titulo;
        row.insertCell(1).innerHTML = database.Unidades[setor.destinatario["setor/instituicao"]].nome;
        row.insertCell(2).innerHTML = setor.data;
    }
}


function cadastrar() {
    let form = document.getElementById("cadastro-form");

    let formData = new FormData(form);

    let remSetor = formData.get("field1");
    let remNome = formData.get("field2");
    let remTel = formData.get("field3");
    let remEmail = formData.get("field4");

    let destSetor = formData.get("field5");
    let destEnd = formData.get("field6");
    let destTitulo = formData.get("field7");
    let destData = formData.get("field8");
    let destDesc = formData.get("field9");

    if(remSetor == "" || remNome == "" || destSetor == "" || destEnd == "" || destTitulo == "") {
        return false;
    }

    if(remSetor == destSetor) {
        alert("Você não pode enviar um protocolo para o mesmo setor!");
        return false;
    }

    console.log(remSetor);
    console.log(remNome);
    console.log(remTel);
    console.log(remEmail);
    console.log(destSetor);
    console.log(destEnd);
    console.log(destTitulo);
    console.log(destData);
    console.log(destDesc);

    let protocol = {
        "id": database.Protocolo.length + 1,
        "data": destData,
        "titulo": destTitulo,
        "remetente": {
            "nome": remNome,
            "setor/instituicao": remSetor,
            "Endereço": ""
        },
        
        "destinatario":{
            "setor/instituicao": destSetor,
            "Endereço": ""
        },
        
        "status": "aberto"
    };


    
    database.Protocolo.push(protocol);
    SaveDB();

    form.reset();
    alert("Protocolo cadastrado com sucesso!");
 }
