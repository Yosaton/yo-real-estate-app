<?php

require '../vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

// $facebook_token = getenv("FACEBOOK_TOKEN");
// $facebook_app_secret = getenv("FACEBOOK_APP_SECRET");
// $facebook_verification = getenv("FACEBOOK_VERIFICATION");

// dd($facebook_token,"facebook token");
// dd($facebook_verification,"facebook_verification");
// dd($facebook_app_secret,"facebook_app_secret");

// FACEBOOK_TOKEN=EAAE3LgC5qc0BAAC6xz5hheZAsUfNgvSZAPsrpzQW9zOXMinvZAtcFmYZA2b5kQIqMZAB12Cp3GZCg6tvWojs7H51Kl5BHdMdAx4XzLhiOyeB4g65sY8iMIZCHTIvauy3ZBnZAul4lcZBWjZBimDeBi1tIbakkB7aaQtDPQZCZABLhUgX0ZBQZDZD
// FACEBOOK_APP_SECRET=ac2d2709515cd77dc9eccfdc6f0665e1
// FACEBOOK_VERIFICATION=abc_123


$config = [
  'facebook' => [
  	'token' => "EAAE3LgC5qc0BAAC6xz5hheZAsUfNgvSZAPsrpzQW9zOXMinvZAtcFmYZA2b5kQIqMZAB12Cp3GZCg6tvWojs7H51Kl5BHdMdAx4XzLhiOyeB4g65sY8iMIZCHTIvauy3ZBnZAul4lcZBWjZBimDeBi1tIbakkB7aaQtDPQZCZABLhUgX0ZBQZDZD",
	'app_secret' => "ac2d2709515cd77dc9eccfdc6f0665e1",
    'verification'=>"abc_123",
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