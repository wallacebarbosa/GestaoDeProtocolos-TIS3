var http = require("http");
var fileManager = require("./filemanager");
var config = require("./config");
var parse = require("url").parse;

var rootFolder = config.rootFolder;
var defaultIndex = config.defaultIndex;
var types = config.types;

var server = http.createServer();



module.exports = server;

server.on('request', OnRequest);

function OnRequest(req, res)
{
    var filename = parse(req.url).pathname;
    var fullPath;
    var extension;

    if(filename == '/') {
        filename = defaultIndex;
    }

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