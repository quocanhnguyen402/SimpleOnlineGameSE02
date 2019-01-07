// var socket = io();
// socket.on('message', function(data) {
//     console.log(data);
// });

// $(document).ready(function() {
    var socket = io.connect("http://dev.mygame.com:5000/");

    socket.on('message', function(data) {
        console.log(data);
    });

    // socket.on('connect', function () {
    //     socket.emit('usersocket', 1);
    // });
// });