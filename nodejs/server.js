/**
 * Created by KayLee on 21/04/2017.
 */
var app = require('express')();
var fs = require('fs');
//var http = require('http');
//var https = require('https');
var privateKey  = fs.readFileSync('/etc/letsencrypt/live/moree.me/privkey.pem');
var certificate = fs.readFileSync('/etc/letsencrypt/live/moree.me/fullchain.pem');
var chain = fs.readFileSync('/etc/letsencrypt/live/moree.me/chain.pem');

var credentials = {key: privateKey, cert: certificate, ca: chain};

var server = require('https').Server(credentials, app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);
io.on('connection', function (socket) {

    console.log("client connected");
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message", function(channel, data) {
        console.log("mew message add in queue "+ data['message'] + " channel");
        socket.emit(channel, data);
    });

    socket.on('disconnect', function() {
        redisClient.quit();
    });

});