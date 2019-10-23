var database = {
    "pessoas": 
    [
        {
            "id": 0,
            "senha": "vasco",
            "nome": "wallace barbosa",
            "setor": 1,
            "email": "wallace-naruto@gmail.com",
            "online": false
        },
        {
            "id": 1,
            "senha": "123456",
            "nome": "andre murilo",
            "setor": 0,
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
                "setor": 0,
                "Endereço": ""
            },
            
            "destinatario":{
                "setor": 1,
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
                "setor": 0,
                "descricao": ""
            },
            
            "destinatario":{
                "setor": 1
            },
            "status": "fechado"
        },
        {
            "id":3,
            "data": "21/09/2019",
            "titulo":"Coleta de documento",
            "remetente":{
                "nome": "maria bonita",
                "setor": 1,
                "descricao": ""
            },
            
            "destinatario":{
                "setor": 1
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
    doget
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
            "setor": SetorInst


        },

        "destinatario": {
            "setor": SetorInst_Dest,
            "endereco": enderecoRemetente
        },
        "descricao": desc,
        "status": status
    };

    database.Protocolo[0].status.
    database.Protocolo.push(event);

    SaveDB();

    return true;
}

function usuarioInProtocolo(protocoloID, Setor_destID)
{
  
    for(var i = 0; i < database.Protocolo.length; i++)
    {
        let protocolo = database.Protocolo[i];
       
        if(protocolo.destinatario.setor == protocoloID)
        {
            
            for(var j = 0; j < database.pessoas.length; j++)
            {
                if(database.pessoas[j].setor == Setor_destID)
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

    
    
    let SetorInst = pegarSetorInst(protocolo.remetente.setor)
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

   
    
}

function pegarSetorInst(number){
    
    for(let i = 0 ; i < database.Setorinst.length;i++){
        
        if(database.Setorinst[i].id == number){
            let SetorInst = database.Setorinst[i].Nome
            
            return SetorInst;
        }
    }
}




// function TableInsertProtocolos()
// {
//     let setores = pegarProtocolosSetor();

//     let table = document.getElementById("table-protocolos");
    

//     for(let i = 0; i < setores.length; i++)
//     {
//         let row = table.insertRow(i + 1);
//         let setor = setores[i];

//         row.insertCell(0).innerHTML = setor.id;
//         row.insertCell(1).innerHTML = `<th><button class="btn" style="background-color:#00b1eb" type="button" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="false" aria-controls="collapseExample">
//         ...
//       </button></th>
      
//       <div class="collapse" id="collapse${i}">
//       <div class="col pt-2" >
//         <button type="button" class="btn btn-outline-success" data-toggle="modal" onclick="ConfirmarR('${i}')">Confirmar</button>
//         <button type="button" class="btn btn-outline-danger">Rejeitar</button>
//         <button type="button" class="btn btn-outline-warning">Reencaminhar</button>

        
        
//       </div>

//       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//         <div class="modal-dialog" role="document">
//             <div class="modal-content">
//             <div class="modal-header">
//                 <h5 class="modal-title" id="exampleModalLabel">${currentUser.nome}</h5>
//                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                 <span aria-hidden="true">&times;</span>
//                 </button>
//             </div>
//             <div class="modal-body">
//                 <div class="input-group">
//                     <div class="input-group-prepend">
//                     <span class="input-group-text">Comentario</span>
//                     </div>
//                     <textarea class="form-control" aria-label="With textarea"></textarea>
//                 </div>
//             </div>
//             <div class="modal-footer">
//                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
//                 <button type="button" class="btn btn-primary" data-dismiss="modal" id="c">Confirmar recebimento</button>
                
//             </div>
//             </div>
//         </div>
//         </div>
//     </div>

//       `;
//         row.insertCell(2).innerHTML = setor.titulo;
//         row.insertCell(3).innerHTML = database.Unidades[setor.destinatario["setor"]].nome;
//         row.insertCell(4).innerHTML = setor.data;
//         row.insertCell(5).innerHTML = setor.status;
        
//     }
// }





function cadastrar() {
    let form = document.getElementById("cadastro-form");
    let formData = new FormData(form);

    let destSetor = $('#field5 option:selected').val()
    console.log(destSetor);
    let destTitulo = formData.get("field7");
    let destDesc = formData.get("field9");
    let anexo = formData.get("field10");

    if(destSetor == "" || destTitulo == "") {
        return false;
    }

    console.log(destSetor);
    console.log(destTitulo);
    console.log(destDesc);

    let cad_protocol = {
        "destSetor": destSetor,
        "titulo": destTitulo,
        "descricao": destDesc
    }


    $.post("ajax/cadastro/protocolo", cad_protocol, function(data) {
        if(data == "1") {
            alert("Protocolo criado com sucesso!");
        } else {
            alert("Nao foi possivel criar o protocolo!");
        }

        form.reset();
    });
 }

function DoLogin(user, pwd, callback)
{
    $.post("ajax/login", {username: user, password: pwd}, function(data) {
        console.log(data);
        if(data == "1") {
            console.log("login verdade!");
            callback(true);
        } else {
            callback(false);
        }
    }) 
}

function DoRequestProtocolos(callback)
{
    $.post("ajax/protocolos", function(data) {
        callback(JSON.parse(data));
    });
}

function DoGetSetores(callback) 
{
    $.post("ajax/setores", function(data) {
        callback(JSON.parse(data));
    });
}

function DoGetUnidades(callback) 
{
    $.post("ajax/unidades", function(data) {
        callback(JSON.parse(data));
    });
}

function DoGetEncaminhamentos(callback){
    $.post("ajax/encaminhamentos", function(data) {
        callback(JSON.parse(data));
    });
}