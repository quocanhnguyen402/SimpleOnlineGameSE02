var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var connectedUsers = {};

// Starts the server.
server.listen(5000, function() {
    console.log('Starting server on port 5000');
});

//Connect mysql database
var mysql = require('mysql')
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'se02_game'
});
connection.connect()

//Leaderboard from db
var leaderboard = [];
getLeaderBoard(connection);

//Array to store rooms
var rooms_nr_client = [];

//When have a connection
io.on('connection', function (socket) {
    console.log("New client connected")
    //Call when the client call socket.emit('get_leaderboard', _);
    socket.on('get_leaderboard', function () {
        getLeaderBoard(connection);
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
            socket.emit('another_join');
            socket.in(room).emit('another_join');
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
    //Call when the client call socket.emit('move_up', _);
    socket.on('move_up', function (room) {
        //Send to all ppl in room except sender
        socket.broadcast.to(room).emit('move_down');
    });
    //Call when the client call socket.emit('move_down', _);
    socket.on('move_down', function (room) {
        //Send to all ppl in room except sender
        socket.broadcast.to(room).emit('move_up');
    });
    //Call when the client call socket.emit('reset_ball', _);
    socket.on('reset_ball', function (room) {
        //Create x and y for the ball vector
        var x = get_random_float(-1, 1);
        var y = get_random_float(-1, 1);
        var obj = {
            x: x,
            y: y,
        };
        //Send to all ppl in room include sender
        socket.emit('reset_ball', obj);
        socket.in(room).emit('reset_ball', obj);
    });
    socket.on('player_right_score', function (room) {
        socket.emit('player_right_score', room);
    });
    socket.on('player_left_score', function (room) {
        socket.emit('player_left_score', room);
    });
});


function getLeaderBoard(connection) {
    connection.query("SELECT user.username as player_name,scores.score as score FROM `scores`,`user` WHERE scores.user_id = user.id AND game_id = 1 ORDER BY scores.score DESC"
        , function (err, rows, fields) {
            if (err) throw err;
            leaderboard = rows;
    });
}

// function addToLeaderBoard(connection, data) {
//     connection.query('INSERT INTO posts SET ?', data, function (error, results, fields) {
//         // if (error) throw error;
//         // console.log(results.insertId);
//     });
// }

function get_random_float(min, max) {
    return Math.random() * (max - min) + min;;
}