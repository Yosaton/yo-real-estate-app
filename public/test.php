<?php

require '../vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
  'facebook' => [
  	'token' => 'EAAE3LgC5qc0BAJzuRKGsVQYYy52gNJjLsXt4EafVjaAMceapduBEMuh6qxOe7Y9Sll9UkPXYKuEFpB77zFZB7eZAP9e386vUOJy3CXU76AMINH7pG24NUQUtS4SmpfKWstJbVanE0cuwEzqNWBZBSGM7TZCmxO0ZCZC7IklrOD0wZDZD',
	  'app_secret' => 'ac2d2709515cd77dc9eccfdc6f0665e1',
    'verification'=>'abc_123',
  ]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create an instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
// $botman->hears('hello', function (BotMan $bot) {
//     $bot->reply('Hello! Are you interested in purchasing a home?');
// });

// $botman->hears('Yes|yes', function (BotMan $bot) {
//   $bot->reply('Great! What size house are you looking for?');
// });

// $botman->hears('No|no', function (BotMan $bot) {
//   $bot->reply('Oh, ok. How else can I assist you today?');
// });

$botman->hears('', function (BotMan $bot) {
  $bot->reply('u suck');
});

// Start listening
$botman->listen();