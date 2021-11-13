var express = require('express')
  , stylus = require('stylus')
  , nib = require('nib')
  , sio = require('socket.io');

var handler     = express();
var fs = require('fs');

/**
 * App.
 */
var privateKey = fs.readFileSync('/etc/letsencrypt/live/openpad.io/privkey.pem').toString();
var certificate = fs.readFileSync('/etc/letsencrypt/live/openpad.io/fullchain.pem').toString();

var app = require('https').createServer({key:privateKey,cert:certificate }, express);



var io = require('socket.io')(app);
var redis = require('redis');
var dnode = require('dnode');




app.listen(1337);

var clients =[];




var redisClient1 = redis.createClient();
redisClient1.on("error", function (err) {
    console.log("Error " + err);
});
  
io.on('connection', function (socket) {
  
  var redisClient = redis.createClient();
  redisClient.subscribe('message');
  redisClient.on("message", function(channel, message) {
    console.log("mew message in queue "+ message + "channel");
    socket.emit(channel, message);
  });
          
  var clientInfo = new Object();
  clientInfo.customId         =  socket.request.connection.remoteAddress
  clientInfo.clientId     = socket.id;
  clients.push(clientInfo);     
  console.log(clientInfo);

  socket.on('joinRoom', function (room) {
    
    var clientsInRoom =[];
    for( var i=0, len=clients.length; i<len; ++i ){
        var c = clients[i];
        if(c.clientId == socket.id){
            clients.splice(i,1);
        
            clientInfo.customId         =  socket.request.connection.remoteAddress
            clientInfo.clientId     = socket.id;
            clientInfo.room = room;
            clients.push(clientInfo);
        }
        
        
        if(c.room == room){
            clientsInRoom.push(c);
        }
        
    }
    socket.broadcast.to(c.room).emit('userJoined', c);
    
    redisClient1.set("user_list-"+room+"", JSON.stringify(clientsInRoom));
    console.log("Joined Room: "+room);
    socket.join(room);
  }); 
  
  socket.on('getUsers', function (room, data) {
    redisClient1.get("user_list-"+room+"", function(err, reply) {
        socket.emit('updateUserList', reply);
    });
  });
  
  socket.on('cursorPositionChange', function (data) {
      console.log("broadcasting to room"+data.room);
      data.client = socket.id;
    console.log(data);
      socket.broadcast.to(data.room).emit('updateCursorPosition', data);
  });


    
    
  socket.on('sharedTorrent', function (data) {
    console.log(socket.nickname+" just shared a torrent.");
    data.whoShared = socket.nickname;
    
    socket.broadcast.emit('shareTorrentWithusers', data);
  });
  
  
  socket.on('savePage', function (data) {
    //console.log("test");
      if (!data) return false;
      dnode.connect(7070, function (remote, conn) {
          remote.zing(JSON.stringify(data), function (n) {
              //console.log('n=' + n);
              conn.end();
          });
      });
      socket.emit('savePageDone', data);
      
    });

  socket.on('auth', function (data) {
      var http = require("https");
      http.get({
        host: 'openpad.io',
        path: '/api/auth?token='+data.token,
    }, function(response) {
        // Continuously update stream with data
        var body = '';
        response.on('data', function(d) {
            body += d;
        });
        response.on('end', function() {
            // Data reception is done, do whatever with it!
            var parsed = JSON.parse(body);
            console.log(parsed.name);
            socket.nickname = parsed.name;
            socket.emit ('authSuccess', body);
            socket.broadcast.emit('userAuthenticated', body);
        });
    });
  });
  
  
  socket.on('disconnect', function (data) {
    console.log("Client Disconnected:"+socket.id);
      var clientsInRoom = [];
      for( var i=0, len=clients.length; i<len; ++i ){
          var c = clients[i], disconnected = false, room = null;
          
          if (typeof c != "undefined") {
            if(c.clientId == socket.id){
                clients.splice(i,1);
                if(typeof c.room != "undefined") {
                  socket.broadcast.to(c.room).emit('userLeft', c);
                  var room = c.room;
                }
            }
          } else {
            clients.splice(i,1);
          }
        
      }
      
      for( var i=0, len=clients.length; i<len; ++i ){
          var c = clients[i];
          if(c.room == room) {
              clientsInRoom.push(c);
          }
      }
      
      redisClient1.set("user_list-"+room+"", JSON.stringify(clientsInRoom));
      
  });
  
});



/* Function to get list of socket.io clients connected */
function findClientsSocket(roomId, namespace) {
    var res = []
    // the default namespace is "/"
    , ns = io.of(namespace ||"/");

    if (ns) {
        for (var id in ns.connected) {
            if(roomId) {
                var index = ns.connected[id].rooms.indexOf(roomId);
                if(index !== -1) {
                    res.push(ns.connected[id]);
                }
            } else {
                res.push(ns.connected[id]);
            }
        }
    }
    return res;
}

function findClientsSocketByRoomId(roomId) {

var allConnectedClients = Object.keys(io.sockets.connected);// This will return the array of SockeId of all the connected clients
return allConnectedClients;

}