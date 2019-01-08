var socket = io.connect("http://dev.mygame.com:5000/");

socket.on('message', function(data) {
    console.log(data);
});