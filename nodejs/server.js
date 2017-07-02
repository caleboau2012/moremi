/**
 * Created by KayLee on 21/04/2017.
 */
var app = require('express')();
var fs = require('fs');
//var http = require('http');
//var https = require('https');
var privateKey  = fs.readFileSync('/var/www/html/moremi/nodejs/privkey.pem');
var certificate = fs.readFileSync('/var/www/html/moremi/nodejs/fullchain.pem');
//var chain = fs.readFileSync('/etc/letsencrypt/archive/moree.me/chain.pem');

//var credentials = {key: privateKey, cert: certificate, ca: chain};
var credentials = {key: privateKey, cert: certificate};

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