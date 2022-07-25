'use strict';
var app = require('express')();
var server = require('http').Server(app);
const { Socket } = require('socket.io');
var io = require('socket.io')(server, {

    cors: { origin: "*" }

});
require('dotenv').config();

var redisPort = process.env.REDIS_PORT;
var redisHost = process.env.REDIS_HOST;
var ioRedis = require('ioredis');
var redis = new ioRedis(redisPort, redisHost);
redis.subscribe('e_commerce_database_channel-one');
redis.on('message', function(channel, message) {
    console.log('new product');
    message = JSON.parse(message);
    console.log(message.data);
    io.sockets.emit('sendToClinet', message);
});


var broadcastPort = 3000;
server.listen(broadcastPort, function() {
    console.log('Socket server is running.');
});
