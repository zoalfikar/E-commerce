'use strict';
var app = require('express')();
var server = require('http').Server(app);
var NRP = require('node-redis-pubsub');
var ioRedis = require('ioredis');
const { Socket } = require('socket.io');
var io = require('socket.io')(server, {
    cors: { origin: "*" }
});
require('dotenv').config();
var redisPort = process.env.REDIS_PORT;
var redisHost = process.env.REDIS_HOST;

var nrp = new NRP({ port: redisPort, host: redisHost });
var redis1 = new ioRedis(redisPort, redisHost);

nrp.on('e_commerce_database_private-store.*', (data, channel) => {
    console.log('new product');
    console.log(data);
    console.log(channel);
    io.sockets.emit(channel, data);
});


redis1.subscribe('e_commerce_database_channel-tow');
redis1.on('message', function(channel, message) {
    console.log('user has login');
    message = JSON.parse(message);
    console.log(message.data);
    io.sockets.emit('sendToClinet1', message);
});

nrp.on("error", function() {
    console.log("some thing went wrong !")
});


var broadcastPort = 3000;
server.listen(broadcastPort, function() {
    console.log('Socket server is running.');
});
