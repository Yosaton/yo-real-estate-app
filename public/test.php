<?php

require '../vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$facebook_token = getenv("FACEBOOK_TOKEN");
$facebook_verification = getenv("FACEBOOK_VERIFICATION");
$facebook_app_secret = getenv("FACEBOOK_APP_SECRET");

$config = [
  'facebook' => [
  	'token' => $facebook_token,
	'app_secret' => $facebook_app_secret,
    'verification'=>$facebook_verification,
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