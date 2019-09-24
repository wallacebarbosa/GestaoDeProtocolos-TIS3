server = require("./server");

process.title = "TIS Web Server";


server.listen(80, function () {
    console.log("Server is started!");
});