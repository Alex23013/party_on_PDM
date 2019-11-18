
var express = require("express");
var app = new express ();
var http = require("http").Server(app);
var io = require("socket.io")(http);

var port = process.env.PORT || 3030;

app.use(express.static(__dirname + "/public"));

app.get('/',function(req,res){
  res.json({'msg': 'success: server runnin'});
});
app.get('/send',function(req,res){
  res.redirect('send.html');
});
app.get('/recive',function(req,res){
  res.redirect('recive.html');
});

io.on('connection',function(socket){

  console.log(io.engine.clientsCount);
  socket.on('stream',function(image){
    console.log("socket.id:");
    console.log(socket.id);
    socket.broadcast.emit('stream',image);
  });

  socket.on('send', function(json){
    console.log(json)

    socket.broadcast.emit('recive', json.data);

  });
});

http.listen(port,function(){
    console.log('Servidor escuchando por el puerto %s',port);
});


