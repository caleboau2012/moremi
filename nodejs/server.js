/**
 * Created by KayLee on 21/04/2017.
 */
var app = require('express')();
var fs = require('fs');
var privateKey  = fs.readFileSync('/etc/letsencrypt/live/moree.me/privkey1.pem');
var certificate = fs.readFileSync('/etc/letsencrypt/live/moree.me/fullchain1.pem');

var credentials = {key: privateKey, cert: certificate};

var server = require('https').Server(credentials, app);
var io = require('socket.io')(server);
var redis = require('redis');

process.env.NODE_TLS_REJECT_UNAUTHORIZED = "0";

server.listen(8890);
io.on('connection', function (socket) {
    console.log("Connected");

    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message", function(channel, data) {
        socket.emit(channel, data);
    });

    socket.on('disconnect', function() {
        redisClient.quit();
    });

});