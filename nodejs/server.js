var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var connectedUsers = {};

// Starts the server.
server.listen(5000, function() {
    console.log('Starting server on port 5000');
});

//Create some fake record
var leaderboard = [
    {
        player_name: "Natashi",
        score: 3
    },
    {
        player_name: "Quoc Anh",
        score: 30
    }
];

//Array to store rooms
var rooms_nr_client = [];

//Compare function to use in the sort leaderboad
function comapre_leaderboard(obj1, obj2) {
    return obj2.score - obj1.score;
}


//When have a connection
io.on('connection', function (socket) {
    console.log("New client connected")
    //Call when the client call socket.emit('get_leaderboard', _);
    socket.on('get_leaderboard', function () {
        console.log(leaderboard);
        //Tell the player to update leaderboard when they submit their score
        socket.emit('update_leaderboard', leaderboard);
    });
    //Call when the client call socket.emit('add_to_leaderboard', _);
    socket.on('add_to_leaderboard', function (object_send) {
        //Push the record to the leaderboard
        leaderboard.push(object_send);
        //Sort the leaderboad
        leaderboard.sort(comapre_leaderboard);
        //Tell the player to update leaderboard when they submit their score
        socket.emit('update_leaderboard', leaderboard);
    });
    //Call when the client call socket.emit('room_create', _);
    socket.on('room_create', function (room) {
        console.log("Room " + room + " created");
        result = socket.join(room);
        rooms_nr_client.push(room);
        socket.emit('created', room);
    });
    //Call when the client call socket.emit('room_join', _);
    socket.on('room_join', function (room) {
        //Variable to check
        var have_room = false;
        //Check if there is a room with the given id
        for (let index = 0; index < rooms_nr_client.length; index++) {
            if (room == rooms_nr_client[index]) {
                have_room = true;
                break;
            }
        }
        //If there is a room join it, if not tell the client there is not
        if (have_room) {
            console.log("New connection at room " + room);
            socket.join(room);
            socket.emit('joined', room);
        } else {
            socket.emit('join_failed', room);
        }
    });
    //Call when the client call socket.emit('move', _ );
    socket.on('move', function (data) {
        var room = data.room;
        var move = data.move;
        socket.in(room).emit('move', move);
    });
});

// setInterval(function() {
//     io.sockets.emit('message', 'hi!');
// }, 1000);