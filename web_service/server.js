// var http = require("http");
// var fileManager = require("./filemanager");
// var config = require("./config");
// var database = require("./database");
// var parse = require("url").parse;
// var queryParse = require('querystring').parse;

// var rootFolder = config.rootFolder;
// var defaultIndex = config.defaultIndex;
// var types = config.types;

// var server = http.createServer();

var path = require('path');
var net = require('net');
var fs = require('fs');

var dir = path.join(__dirname, 'public');

var mime = {
    html: 'text/html',
    txt: 'text/plain',
    css: 'text/css',
    gif: 'image/gif',
    jpg: 'image/jpeg',
    png: 'image/png',
    svg: 'image/svg+xml',
    js: 'application/javascript'
};

var server = net.createServer(function (con) {
    var input = '';
    con.on('data', function (data) {
        input += data;
        if (input.match(/\n\r?\n\r?/)) {
            var line = input.split(/\n/)[0].split(' ');
            var method = line[0], url = line[1], pro = line[2];
            var reqpath = url.toString().split('?')[0];
            if (method !== 'GET') {
                var body = 'Method not implemented';
                con.write('HTTP/1.1 501 Not Implemented\n');
                con.write('Content-Type: text/plain\n');
                con.write('Content-Length: '+body.length+'\n\n');
                con.write(body);
                con.destroy();
                return;
            }
            var file = path.join(dir, reqpath.replace(/\/$/, './static/protocolos.html'));
            if (file.indexOf(dir + path.sep) !== 0) {
                var body = 'Forbidden';
                con.write('HTTP/1.1 403 Forbidden\n');
                con.write('Content-Type: text/plain\n');
                con.write('Content-Length: '+body.length+'\n\n');
                con.write(body);
                con.destroy();
                return;
            }
            var type = mime[path.extname(file).slice(1)] || 'text/plain';
            var s = fs.readFile(file, function (err, data) {
                if (err) {
                    var body = 'Not Found';
                    con.write('HTTP/1.1 404 Not Found\n');
                    con.write('Content-Type: text/plain\n');
                    con.write('Content-Length: '+body.length+'\n\n');
                    con.write(body);
                    con.destroy();
                } else {
                    con.write('HTTP/1.1 200 OK\n');
                    con.write('Content-Type: '+type+'\n');
                    con.write('Content-Length: '+data.byteLength+'\n\n');
                    con.write(data);
                    con.destroy();
                }
            });
        }
    });
});

server.listen(3000, function () {
    console.log('Listening on http://localhost:3000/');
});



module.exports = server;

server.on('request', OnRequest);

function GetSetorByID(id) {
    for(let i = 0; i < Setor.length; i++)
    {
        if(Setor[i].id == id) {
            return Setor[i];
        }
    }

    return null;
}

function GetUnidadeByID(id) {
    for(let i = 0; i < Unidade.length; i++)
    {
        if(Unidade[i].id == id) {
            return Unidade[i];
        }
    }

    return null;
}

function WriteNormalHead(res, length)
{
    res.writeHead(200, {
        'Content-Type': "text/plain",
        'Content-Length': length
     });
}




function OnRequest(req, res)
{
    // parse path request
    var filename = parse(req.url).pathname;
    var fullPath;
    var extension;

    // if request is root file
    if(filename == '/') {
        filename = defaultIndex;
    }

    console.debug(GetSetorByID(1).nome);

    // if request is ajax
    if(req.method == 'POST') {
        console.debug("POST REQUEST!");

        let body = '';
        req.on('data', chunk => {body += chunk.toString();});
        req.on('end', function() {
            console.debug(body);
            console.debug(filename);

            switch(filename)
            {
                case "/ajax/login":
                    console.debug("Login request!");
                    let quered = queryParse(body);

                    let user = quered.username;
                    let pass = quered.password;

                    ob = '';

                    for(i = 0; i < Usuario.length; i++){
                        if(Usuario[i].nome == user && Usuario[i].senha == pass) {
                            ob = '1';
                            res.writeHead(200, {
                                'Content-Type': "text/plain",
                                'Location': "protocolos.html",
                                'Content-Length': ob.length
                             });
                            res.end(ob);
                            currentUser = Usuario[i]
                        }
                        else
                        {
                            ob = '0';
                            WriteNormalHead(res, ob.length);
                            res.end(ob);
                        }
                        break;
                    }


                
                case "/ajax/protocolos":
                    let data = []
                    
                    for(let i = 0; i < Protocolo.length; i++)
                    {
                        let protocol = Protocolo[i];
                        let p = {
                            "id": protocol.id,
                            "titulo": protocol.titulo,
                            "setor": GetSetorByID(protocol.owner_setor).nome,
                            "data": protocol.dataCriacao,
                            "descricao": protocol.descricao,
                            "status": "Criado"
                        }

                        data.push(p);
                    }

                    ob = JSON.stringify(data);
                    WriteNormalHead(res, ob.length);
                    res.end(ob);
                    break;
                
                case "/ajax/setores":
                    let data2 = []
                    for(let i = 0; i < Setor.length; i++)
                    {
                        data2.push(Setor[i]);
                    }

                    ob = JSON.stringify(data2);
                    WriteNormalHead(res, ob.length);
                    res.end(ob);
                    break;
                    
                
                case "/ajax/unidades":
                    let data3 = []
                    for(let i = 0; i < Unidade.length; i++)
                    {
                        data3.push(Unidade[i]);
                    }

                    ob = JSON.stringify(data3);
                    WriteNormalHead(res, ob.length);
                    res.end(ob);
                    break;

                case "/ajax/cadastro/protocolo":
                    console.debug("Request Cadastro.");
                    let quered2 = queryParse(body);

                    let destSetor = quered2.destSetor;
                    let titulo = quered2.titulo;
                    let desc = quered2.descricao;


                    let protocol = {
                        "id": Protocolo.length + 1,
                        "titulo": titulo,
                        "dataCriacao": 1570661981, // timestamp
                        "owner_id": 1,
                        "owner_setor": destSetor,
                        "descricao": desc
                    }

                    let rota = {
                        "id": 1,
                        "protocolo_id": protocol.id,
                        "remetente_id": 1,
                        "destinatario_id": destSetor,
                        "tipo": "criado",
                        "data":  1570661981, // timestamp
                    }
                    ob = '1';
                    WriteNormalHead(res, ob.length);
                    res.end(ob);
                    break;

                    case "/ajax/encaminhamentos":

                            let data4 = []
                            for(let i = 0; i < Encaminhamentos.length; i++)
                            {
                                data4.push(Encaminhamentos[i]);
                            }
 
        
                            ob = JSON.stringify(data4);
                            WriteNormalHead(res, ob.length);
                            res.end(ob);
                            break;
                    
            }
        });

        return;
    }


    // send file data
    fullPath = rootFolder + filename;
    extension = filename.substr(filename.lastIndexOf('.') + 1);

    fileManager(fullPath, function(data) {
        res.writeHead(200, {
           'Content-Type': types[extension] || 'text/plain',
           'Content-Length': data.length
        });
        res.end(data);

    }, function(err) {
        res.writeHead(404);
        res.end('Recurso não encontrado');
    });
    
}