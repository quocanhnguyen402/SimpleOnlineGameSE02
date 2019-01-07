var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var connectedUsers = {};

// Starts the server.
server.listen(5000, function() {
    console.log('Starting server on port 5000');
});

// Add the WebSocket handlers
io.on('connection', function(socket) {
    console.log("New client connected");

    // socket.on('usersocket', function(data) {
        // connectedUsers[data] = socket;
        // console.log("new client with Id: " + data + " added to CLIENTS list");
    // });

});

setInterval(function() {
    io.sockets.emit('message', 'hi!');
}, 1000);