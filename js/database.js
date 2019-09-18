var database = {
    "pessoas": 
    [
        {
            "id": 0,
            "senha": "vasco",
            "nome": "wallace barbosa",
            "idade": 18,
            "faculdade": "Puc Minas",
            "curso": "Engenharia de Software",
            "email": "wallace-naruto@gmail.com",
            "img": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMSEhUQEBIVFRUVFRUVFRUVFRUVFRUVFRUWFhUWFRcYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAAAQQGAgUHAwj/xABAEAABAwEGAwQHBwIEBwAAAAABAAIRAwQFEiExQQZRYRMicYEHMpGhsdHwFCMzQlLB4WJyFYKy8RY0Q1OSouL/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A64hJCBoQhAIQhAIQhALF7w0SSAOZMBQ70vJtEaYnkEtYNTGp6DqqVb69oqg1a1djADkxgmB1dM+5Bef8SpZ/esy17wUUX5ReD2VRriAcg7PLpuuQXreL6ncLi4AyDvPn81qal5Ob6pzG+aDpfEPF9QPFOkYbhMuEEuJAmOUT9QtXd9/tbLaxL2ky18w9p8RoVzp16v8AzGfPLPXJOvbJ035bHmg65dnF7RLHvxFpyd+obYusbqzWa/KVRoLXCcspzzXzv/iDpkHxW5u2+zlnmNfmg77QtIdofr6+C9lyHhziB1KriDi5ru6ZOknXPkT7yup3feDKzQ9h8RuMpQS0IQgEIQgEIQgEISQNCSEDlCSEAhCEAhCEDQlKEDSJQqNxpxaGF1moGXj8Qj8uXq+OYlBjxLfTBUqNa7MgNLhnAE90EePxVMva/nHu5tEaDMHlMrR2+8SSZnMyTMz4rVVK5flOIddR4QglWu8n+rJJOi1zrQG+s+TyAyB6816PqBrciJ0GpOevRQi0HYIPSpaSTkQfIT79V5fa9nCOoyIRWpDcmeQ2Xk9w3B8Sg9xU3BB68/HkV6U60H6zUCQDLfYm+pKDd0LxIMTkfceYVx4Z4gcwgh8GInUEdRuOi5cKxGq2lhtBcO6cxqN/EIO+XNxa2oezeIds7aQJgx8VaWVJXz3dV7EOBxEEEGRuNPhK6fw/xJ3WMec8mtds4RIB5GCI8UF6QvOlUkZcgfas0AhCEAhNJA0kIQCaSEClCEIBNJNAIQhAiV8/3o407RXa497tqhMRu4nXnmux8ScT0bI2HHFUOTWDWY/MfyjmuH3pbMdV1UmXvcXO6E5/JArRiedMtyQoFofHdaIHSJPjCwtVtd6sxzO7jyUy7LC5wJ0kwANSeQ3Qa37M47R7yvN4w6SSPYFa3XW5oIAA555x4hayrdZHRBX3OO/uSDJ0W5N1uOQW0uvhwkguCCvWO7i/QLeWDhomJG4/lXS7bja0DJbuz2IDZBzy28EgtkSCqfbLsq2Z+Y032813x9nC0F+XK2q0gjPYoOV06s99sg8luLuvVxBaCRhbPhEAfsPYtbedjdZ3Fp0269FApVc94/YZx7kH0PcV7l7LOT+YDF0BYTBHjurQCuNcMcUU2URjcHPya1ok5BoEkxroPABdSua1Y6bAJmJdPt95+CDaIQhAIQhAIQhAISlNAkIQgEIQgaSEIOK+lE9naiWklzhDANG4tSBzkOVCtBNMd7U68+n7ronHlj7O21azzPqmmDsC0e4Z+1c6tE1XztigdSeSCwcF3D9of21QSxmQ6u19yvljudlMktbqcypPDF3No2dlMCIGfidVuGUUGjr2EclrqlzTmFcHWYFYCzhBVrLccGSFvKFhA2WwFJZYUHg2mOSya1ZkJQgcKPXoqQsiJQUji24RWYSNRmFyW2WYsJaRGa+grfSlq5DxlY8DzGWaDSXZaixwgCdPVE5/FfQXo6vCnVoFtPIsIxNMhzSRqZzzIJ/iF89WSjJ18F2D0VWxz3w6S5rHMc46uZ3DTnnBxwepQdRTSQgEIQgEIQgE0kIBCSaAQhCAQhCDinpPtJdbKtM/0NHhgB/c+1Vu66LTaabBo2D56/z5re+l8Fltc79TGH2t/wDlVrhGrirydyg7Ndre4FPaFEsHqjwUyEGTViWrIOATLkGBasVk4hYSgIShBesS9AQmCse0RiQedqEhcv45oTUbkupVDkud+kGjhw1BsUFJfTMcjI05DRdK9EDSaj3TmBn1k5rm9KvLp2w5rq3ojsuVWrHIeZ1+CDpaaSaAQhCAQhCAQiEIEmkhA0JIQNCSEHLvTXcbnsZa26NHZv6Zyx3hm5v+YLn/AKP6GKuB0n3r6Cv6wC0WatQP/UpuaP7olp8nALivo2shbaqrXDNjYPQgwg6hQECAla7zZTycYK1t+Wl1Nks1VAvavVMkySc/4goL5aeKaDdXx01Ki/8AF9F3qu/ZckrtcT33j3SnZxTmA7NB2uhezHjIr1rW8NElUHhlz3uDRmFbLxu15bvogh2/iVrJMrQ1vSDhMYJWmvamWuIPNV+vaGzAbPhz5DmgutLjzEdI8St9dXE4JmoSGnQ7eC5X3B69Ko2MycDhA5norDcr6ToDX+GceyUHUKVvbVEsM+RVd43s2OzPPLNSuG7PhJzmei2PEdEGzVR/Qfgg4bQmcIzn98gF9G8AXYbPZGMcIc7vO8SBA9kLjno4uYV7YMQ7lOHOnTXKV9DNCBhNCECQhNAk0k0AhCEGKaSEDQkEIGhCEHja7SKbcTp8BquTcFkOt1qqARiLiBvHaFXP0jds2gyvQJBpv74GYLSI7w3E/FUngmoTbK7nCJaDH9xBQXC9Kct3XML0s9etVLQxzWTGIg4QOcfmPuXXwwFeNqsOIZAeaDiN73M6i402sa7dtR+MlzSNcjhkGdAPNeBuR8YmMcZdkIdoAM88xnMLrNtumodKY/8AMgewKLR4ddMuPkMgPPUoIvBN1uplrnTmJIOo8Vea8EKFY7LgEanmprwg55xRcuIuIykZbBViycPw1zSQXEggjPCQQfYutWiyh2RWsrXAw7eYyKCgXdw29tUPa4jvBxgvBIBmNoWzqcGF7zUa8MLjJaNJ1noeqtlLh4f9x/hK2lmu8MyHvQai5rA+mAHmSMp5qVfjfuKgG7SPctvgUK3DunwQcq4K7tSq5wnCMRAOWQJXZ+B7zNpsoqluEY3NAmchG/muT8LWcGtXpgd54e1viZhdpuK7W2ahToN/KM+rjm4+1BPQkhAJpIQNCSJQNCUoQYoCEIGhJNA0JIQY1abXtLXCQ4EEcwVy2yWf7Pedaj+pgI8BEe5dVlc641odleNC0bVG4D4gkfu1BY6ByUrEoNM5L1a5B6vMpNaAm0LF7oQYELJ4yWLIykwm+s2dUEcHNejivFxziQsGVpy5IJCYevNpPkglB6OetTfNcNpuJ2BUx71WuMbVhpEDfJBE9HNkNW1isPVaXGfIn9x7V16VSPRVYiyydo5sGo8ls/oGQ8iQSrqgaEk0BKEkSgcoSQgaEIQYoQhA00kIBNCEBKp/pHup1WkytTEuouxkDUs1cB1EA+SuCwrMDmlp0IIPgRBQVSwVMTARyCmMUCwsLRAGY1B6ZDzU5r41hB6zuolZ8mAvSpVCKUDMlBTrXeVsFpDWMDqQPfxZEDm081i++3dp2cEfLmtzfdpZpuqZb7W0ukRibkYQMXjbftEnD2RMNDcyB16q52VzgZdvBVb4ftbS4gxP+ys9a0NIyIlBsWlDnLV0LxE4TqveraJybt9c0BaKsLR2mwfa6lKg6cJe3EBlLRmcxplOan1TO07b56exT+FaQdXLiM2tJ8MR0HtQW+jSaxoYwANaAGgaADIL0lYymEDlCUolA0JIQNCUpIHKEShAJpJoGhJNAJpIQCEIQU+2wyrUbOeMnM8wCPiAkK/X6HJSeKKRbUFQDJ7cOgyc3T2g/wDqtI6tB356afUoPa3WzBmSq/Zb8fWeWtOcjKdBvKjcWWpzu6w65AZ+/wB68bg4Pwt7So52I55OI8jBzQWF7KLc6lXvZdfKFr7Tdtlk1O0Akz/ELytXDdF2rXg8xUeBHtWptPDYiBUqxyxk5eOqDaMZQxTTqgZZB2Xs9y194W91IgucMJiDi+ui8rLw22YAeTuS90fFbdnCtGJcMR/qJMeEoIlmtJqltRrsxqNyFYe3gRvh81WKdk+zvODScwtrRrSc/KY8vrog3DaoIBjOIHX381v+Dqf3b6hHrOwjwaPmSqcKwc2Oog5zJz0+a6LdFk7KjTp7hon+45u95KCbKEkAoGhJNA0JIlAJpIQOUJIQNNJOUDQhCAQhCBpFCEEC+7F21FzB60S08nDT5eaoHaS2COQPSdQ4HeV01UXjW7+yf27Gy2oe9/S4AZ+B/ZBWbws2JwDfHI+2ZVluyoMAbuFW6daRlOWpImZzgLY3dViCfdp5nVA75tNRs4Gzlr1VXq3xUxQJkahX4Q4TstPUuxmPFAn6+aDX3faKhglbKtaIb1Xv2DdMhll5LS3jaNRHKPFBErVZqYjMzn9DZe9CrhjrEfuM1p7RWMziyfHUgnZZ2as9xwgd4yBHPmOQQW7hSz9tat8LO+7KROQDfFdHWg4LsPZWfOC9ziXOG+widlvkDTSQgaEkIGUkIQCaSEDhCSEGSaxWQQNNYpoGhJCBoSQgFpOJajS1tMwSZOHm0CD8QoN98XCm7s6ADiNXn1f8o38VWbvtD61pdUqOJPZk+bnNnLoAEGpvm6jSca1IEiMxqWjkOii3ZeYIzMnPLboPeFc6rVWb1uIOJfS7jiZPIn9kE8Xs1pjmPACFhVvNpz5dVT7fQrtkuYZ2Lc/9lp32iqMjiGc6IL3UvOZEQNiDOcLS2m2ee4nKM952zWhp2+phDQDqTEc1Mslgq1XCch11QMv7R4ZTEzlkd/krtc9gFISc3mM+Q5BRLsu1lIQ0Z7nn5rd00Fg4YvRrnPszu65kFv8AW1wmR1BlWNcfvi0kWnumC1jQSMiCSTr5r2uri60UH4S81GDPDUOLI8nHMe1B1pNQrqvFloptqUzqM27tPIqYgaEkIAoQhA0JIQNCUoQZJhCEDQkCsatVrRLnBo5kgD2lB6Sktbab9oME4w7o3vfwqlb+JKtZxa04Gf05HzOqC43ve9OzMx1D4NHrE/sqjeXFNWo3A0CmHgiBm6N5PhyWgvJxJaCTAMk/MrzrOEud+luXmg11mtGJ9TEZLXQOgjotjdVrDK7XO0dLD0DtPeAq3YHHtHH9XxW0dmI5oL1VZCg1mclFuO8+0b2VQ99gif1t2PjzU6qg1tRi11qsTHaiVtqzFFe1BpxdrAZAU+zUQ3QLNzCs6bUEhgUuiFHY07qNb7yDAWszcRl06oNDaJ7as471HAeDTA9wWtvQQQ4eClgwOfzXhaG46biNiAEG3ua0k0+65zSBq1xaY8QVYLl4vrUfu601mcyYePM+t5qmcO1oJbzWwraoOiVeOLOGlwbULtmwBPnMBa+w+kFrnhtWlgadw7ER5QqSQYUWtRykIO6Uawe0PYQWkSCN1muQXTfdZlP7uo5pbqAcvMHJbe7OI6/4hqFxJzBzb7NvJB0hC1t2XzTqsxFzWlsYwSBE7ydiprrUwQC9onSXDPwQeyFjKEHjabfTpiXvA6TJPkFX784ga+mWU8WZEuOWQ2CqtCuR63t+Y2StRc5ruzOecToeiCWL8rUCG03wx2xgwek6KPeV6PeQaryeR28IWqfWNWgT+ent4bfFYV6mKkx3QFBtBXxd0LwbaQx/ZjTc7yot31s1FtDj9pjwQSr/ALThaGjUlYtnsDOp+Sh3y7FUaOS2LmfchBrLFZu6TuFIaZEjf6zUm7QIIUTBDnDrMfJB6UnEEOaYcPr2Kz2C0io2d91VMSl2O1FhkILM+iCo9SyLOyW1rxlryUjGg1/2fNeraMbKUh6DS3nai3ujU8lX7RVzjU7lbG9bQ3ES3M6T8lpHmNfNBlWfAXrZGfcQdyvIN7snU+4KZREUgghWNmGoOq2NrdmotRsFp6hSrUMz5IPXDkvMskKQW5LFzO6giWRkPLdnAhelieezb/dn75SdlUaeiK3da6P1/wCo/wAoJrLQTnrsApZqhgxPMn60CgWRvy+ZWdN7apkDusMT+ojUAfugn/4h0chYYunwTQetbbwPwWFk9QfXNJCCDY/xq/kodl/AZ4H4poQZ2LVedp/5sf2j900II9q/FW4b+EmhBHu3UryqfilCEEZ+rvE/6gvVqEIJti1HiFY3aJoQCj2/8JyEIKbU9dQ7Rt9blCEEqr6o8FIb+G3wCEIPOt+XxUm0+sPJCEEp2gQ/1UIQQqnrs8Ci16H++n8WpoQe9D1fJYXH+E3z+JQhBPQhCD//2Q==",
            "online": false
        },
        {
            "id": 1,
            "senha": "123456",
            "nome": "andre murilo",
            "idade": 19,
            "faculdade": "Puc Minas",
            "curso": "Engenharia de Software",
            "email": "andre92@academyclub.com",
            "img":   "data:image/jpeg;base64,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",
            "online": false
        }
    ],

    "amigos": 
    [
        {
            "userID": 0,
            "friendID": 1
        },
        {
            "userID": 1,
            "friendID": 0
        }

    ],

    "temas": 
    [
        {
            "id": 0,
            "categoria": "Jogos",
            "sub_categoria": "Tabuleiro",
            "eventos_afiliados": [0, 1]
        },
        {
            "id": 1,
            "categoria": "Jogos",
            "sub_categoria": "Eletronico",
            "eventos_afiliados": [2]
        },
        {
            "id": 2,
            "categoria": "Festas",
            "sub_categoria": "Aniversario",
            "eventos_afiliados": []
        }
    ],

    "eventos": 
    [
        {
            "id": 0,
            "criador": 0,
            "titulo": "Xadrez",
            "descricao_title": "Xadrez na casa do josé",
            "descricao": "Galerinha do bem, vai rolar Xadrez no tio José. Bora lá gente!!!",
            "pessoas": [0, 1],
            "data_criacao": "02/12/2018",
            "data_termino": null,
            "turno": "M"
        },
        {
            "id": 1,
            "criador": 1,
            "titulo": "Damas",
            "descricao_title": "Jogar damas depois da faculdade!",
            "descricao": "Se puder, cada um trazer seu tabuleiro.",
            "pessoas": [1],
            "data_criacao": "28/11/2018",
            "data_termino": null,
            "turno": "T"
        },
        {
            "id": 2,
            "criador": 1,
            "titulo": "League Of Legends",
            "descricao_title": "Bora jogar um LoL Galera!!!",
            "descricao": "Toda noite esta rolando um Lozinho pessoal!",
            "pessoas": [1],
            "data_criacao": "24/11/2018",
            "data_termino": null,
            "turno": "N"
        }
    ]
};

var currentUser;



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
        for(i=0;i < database.pessoas.length; i++){
            if(database.pessoas[i].online == true){
                currentUser = database.pessoas[i];
            }
        }
    }
}


function IsEventosHaveName(nome)
{   
    for(let i = 0; i < database.eventos.length; i++)
    {
        if(database.eventos[i].titulo == nome)
        {
            return true;
        }
    }

    return false;
}

function pegarIdTemaPelaSub(sub)
{
    for(let i = 0; i < database.temas.length; i++)
    {
        if(database.temas[i].sub_categoria == sub)
        {
            return i;
        }
    }

    return -1;
}

function AddEventoNoTema(eventoID, temaID)
{
    for(let i = 0; i < database.temas.length; i++)
    {
        if(database.temas[i].id == temaID)
        {
            database.temas[i].eventos_afiliados.push(eventoID);
        }
    }
}

function pegarProxIDEvento()
{
    return database.eventos.length;
}

function cadastrarEvento(nomeEvento, temaID, dataCriacao, dataTermino, desc_titulo, desc, turno)
{
    let nextID = pegarProxIDEvento();


    let turn = "";
    switch(turno)
    {
        case "Noite":
            turn = "N";
        break;
        case "Tarde":
            turn = "T";
        break;
        case "Manha":
            turn = "M";
        break;
    }


    let event = 
    {  
        "id": nextID,
        "criador": currentUser.id,
        "titulo": nomeEvento,
        "descricao_title": desc_titulo,
        "descricao": desc,
        "pessoas": [],
        "data_criacao": dataCriacao,
        "data_termino": dataTermino,
        "turno": turn
    };
    event.pessoas.push(currentUser.id);
    AddEventoNoTema(nextID, temaID);

    database.eventos.push(event);

    SaveDB();

    return true;
}










function SaveUser()
{

    if(currentUser == null) return;

    for(var i = 0; i < database.pessoas.length; i++)
    {
        if(currentUser.id == database.pessoas[i].id)
        {
            console.log("Salvando usuario ..." + i);
            database.pessoas[i] = currentUser;
            return;
        }
    }

}

function estouLogado()
{
    if(currentUser == null)
    {
        return false;
    }
    else 
    {
        return true;
    }
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


function SetUserImage(imgData)
{
    currentUser.img = imgData;
    SaveUser();
    SaveDB();
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


function usuarioInEvento(eventoID, userID)
{
    for(var i = 0; i < database.eventos.length; i++)
    {
        let evento = database.eventos[i];

        if(evento.id == eventoID)
        {
            for(var j = 0; j < evento.pessoas.length; j++)
            {
                if(evento.pessoas[j] == userID)
                {
                    return true;
                }
            }
        }
    }

    return false;
}


function pegarUsuario(userID)
{
    for(let i = 0; i < database.pessoas.length; i++)
    {
        let pessoa = database.pessoas[i];
        if(pessoa.id == userID)
        {
            return pessoa;
        }
    }

    return null;
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

function pegarMeusEventos()
{
    if(currentUser == null) {
        return null;
    }

    let eventos = [];

    for(var i = 0; i < database.eventos.length; i++)
    {
        let evento = database.eventos[i];

        if(usuarioInEvento(evento.id, currentUser.id))
        {
            eventos.push(evento);
        }

    }

    return eventos;
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

function pegarMeusEventosQueSouDono()
{
    if(currentUser == null) {
        return null;
    }

    let eventos = pegarMeusEventos();

    let result = [];

    for(var i = 0; i < eventos.length; i++)
    {
        if(eventos[i].criador == currentUser.id)
        {
            result.push(eventos[i]);
        }
    }

    return result;
}

function pegarTemaAfiliado(eventID)
{
    for(var i = 0; i < database.temas.length; i++)
    {
        let tema = database.temas[i];

        for(j = 0; j < tema.eventos_afiliados.length; j++)
        {
            if(tema.eventos_afiliados[j] == eventID)
            {
                return tema;
            }
        }
    }

    return false;
}


function pegarHTMLGrupo(evento, filter)
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


    let aditional = "";
    if(!filter) {
        aditional = ""
    } else {
        aditional = `<input onclick="SairDoEvento(${evento.id})" class="btn btn-secondary" type="button" value="Sair">`;
    }

    html = `
        <div class="card text-center col-10 p-0 ">
            <div class="card-header border-0 shadow-sm bg-dark text-white m-0 col-12 float-left">
                <span class="float-left ">${title}</span>
                <div class="d-inline float-right"><span>Data: ${evento.data_criacao} - ${turno}</span></div>
            </div>

            <div class="d-inline float-right">
                <p>Visualizar</p>
            </div>
            <div class="card-body">
                <h5 class="card-title">${evento.descricao_title}</h5>
                <p class="card-text">${evento.descricao}</p>

              
            </div>

            <div class=" col-12 card-footer text-muted">
                <div class="user-manager d-inline left">
                    <span class="font-weight-bold">Dono: ${dono.nome} </span>
                    <a class=""><img src="${dono.img}"></a>
                </div>

                <div class="user-participants d-inline left">
                    <span class="">Participantes:</span>

                    ${participantes}

                    <!--
                    <a class=""><img src="img/sem-foto-perfil.jpg"></a>
                    <a class=""><img src="img/sem-foto-perfil.jpg"></a>
                    <a class=""><img src="img/sem-foto-perfil.jpg"></a>
                    <a class=""><img src="img/sem-foto-perfil.jpg"></a>
                    <a href="#" class="badge badge-dark display-2" >14+</a>
                    -->
                </div>

                <div class="d-inline mt-2 float-right">
                    ${aditional}
                   
                    <form action="evento.html" method="get" style="display:inline">
                        <input type="hidden" name="eventoID" value="${evento.id}" />
                        <input class="btn btn-secondary" type="submit" value="Visualizar">
                        <!-- <input type="submit" value="Go to Google" /> -->
                     </form>
                </div>
                
                <!-- <div class="d-inline mt-2 float-right"><span>Criacao: ${evento.data_criacao}</span></div> -->
            </div>
        </div>`;

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

