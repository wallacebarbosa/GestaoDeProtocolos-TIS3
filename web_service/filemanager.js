var fs = require('fs');

module.exports = function(fileName, sucessPtr, errorPtr) {
    fs.readFile(fileName, function(err, data) {
        if(err) {
            errorPtr(err);
        } else {
            sucessPtr(data);
        }
    });
};