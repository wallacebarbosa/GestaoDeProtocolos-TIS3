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


function cadastrarProtocolo(nome, dataCriacao, SetorInst, desc, SetorInst_Dest,titulo,telefone,email,enderecoRemetente)
{
   
    let status = "aberto"
    let count;
    for(let i = 0; i < database.Protocolo.length; i++)
                        {
                    count = i;
                        }
       let event = 
    {  
    
            
        
        "id": count,
        "data": dataCriacao,
        "titulo":titulo,
        "remetente":{
            "nome": nome,
            "telefone": telefone,
            "email": email,
            "setor/instituicao": SetorInst
            
            
        },
        
        "destinatario":{
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



function pegarEventoPelaID(eventoID)
{
    for(let i = 0; i < database.eventos.length; i++)
    {
        if(database.eventos[i].id == eventoID)
        {
            return database.eventos[i];
        }
    }

    return null;
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


function pegarTodosEventos()
{
    let eventos = [];

    for(var i = 0; i < database.eventos.length; i++)
    {
        let evento = database.eventos[i];
        eventos.push(evento);
    }

    return eventos;
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


function pegarEventosQueNaoEstou()
{
    if(currentUser == null) {
        return null;
    }

    let eventos = [];


    for(var i = 0; i < database.eventos.length; i++)
    {
        let evento = database.eventos[i];

        if(!usuarioInEvento(evento.id, currentUser.id))
        {
            eventos.push(evento);
        }
    }

    return eventos;
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


function LimparModal()
{
    $("#model-container").empty();
}

function FecharModal()
{
    $('#modal_grupos').modal('hide');
}

function EntrarEvento(eventoID)
{
    if(usuarioInEvento(eventoID, currentUser.id))
    {
        alert("Você já é desse grupo!");
        return;
    }


    for(let i = 0; i < database.eventos.length; i++)
    {
        if(database.eventos[i].id == eventoID)
        {
            database.eventos[i].pessoas.push(currentUser.id);
        }
    }

    alert("Você entrou no grupo com sucesso!");
    LimparModal();
    FecharModal();


    SaveDB();
}


function pegarHTMlModel(evento)
{

    let tema = pegarTemaAfiliado(evento.id);
    let dono = pegarUsuario(evento.criador);

    // formatar title
    let title =  tema.categoria + " > " + tema.sub_categoria + " > " + evento.titulo;

    // formatar participantes
    let participantes = "";
    let len = evento.pessoas.length;

    if(len > 4)
    {
        for(let i = 0; i < evento.pessoas.length; i++)
        {
            if(i == 4) break;
            let pessoa = pegarUsuario(evento.pessoas[i]);
            participantes += `<a class=""><img src="${pessoa.img}"></a>`;
        }

        participantes += `<a href="#" class="badge badge-dark display-2" >${len - 4}++</a>`;

    }
    else
    {
        for(let i = 0; i < evento.pessoas.length; i++)
        {
            let pessoa = pegarUsuario(evento.pessoas[i]);
            participantes += `<a class=""><img src="${pessoa.img}"></a>`;
        }
    }


    // formatar turno
    let turno = "";
    switch(evento.turno)
    {
        case "T":
            turno = "Tarde";
        break;
        case "M":
            turno = "Manha";
        break;
        case "N":
            turno = "Noite";
        break;
    }


    let html = `
    <div class="card text-center col-10 p-0 ">
        <div class="card-header border-0 shadow-sm bg-dark text-white m-0 col-12 float-left">
            <span class="float-left ">${title}</span>
            <div class="d-inline float-right"><span>Data: ${evento.data_criacao} - ${turno}</span></div>
        </div>
        <div class="card-body">
            <h5 class="card-title">${evento.descricao_title}</h5>
            <p class="card-text">${evento.descricao}</p>
        </div>
        <div class=" col-12 card-footer text-muted">
            <div class="user-manager d-inline left">
                <span class="font-weight-bold">Dono: ${dono.nome}</span>
                <a class=""><img src="${dono.img}"></a>
            </div>
            <div class="user-participants d-inline left">
                <span class="">Participantes:</span>
                ${participantes}
            </div>
            <!-- <div class="d-inline mt-2 float-right"><span>Criacao: ${evento.data_criacao}</span></div> -->
            <button type="button" onclick="EntrarEvento(${evento.id})" class="btn float-right btn-secondary">Entrar</button>

        </div>
    </div>`;

    return html;
}


function isInArray(array, search)
{
    return array.indexOf(search) >= 0;
}


function SairDoEvento(eventoID)
{
    for(let i = 0; i < database.eventos.length; i++)
    {
        if(database.eventos[i].id == eventoID)
        {
            let index = database.eventos[i].pessoas.indexOf(currentUser.id);
            if(index == -1) return;
            database.eventos[i].pessoas.splice(index, 1);
        }
    }

    SaveDB();

    location.reload();
}

function verifique(){

    if(estouLogado() == true){ 

        alert("Acesso nao permitido!!!")
        window.location.replace("index.html")
    }
 }

 function logout(){

    for(i=0; i < database.pessoas.length; i++){
        currentUser = database.pessoas[i]

        if(currentUser.online == true){
            currentUser.online = false;
            SaveDB();
            break;
        } 

    }

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
