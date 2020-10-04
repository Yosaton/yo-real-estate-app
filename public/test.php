<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$config = [
  'facebook' => [
  	'token' => 'EAAE3LgC5qc0BABy5FZA0BGgxQQZCBoR0ZAOAmx2488qQZB0BW75ZBik3U2kXqJX2VlOve9IOjE8vFAc7rxbOeTAZCjLUZCm5Qj1dKDgJQ3oDg0gY7sbtNtSclDTruLiygy1dKoOZAJ1oyTlMZC74K1an9H4ubOJ1OGAkXZBinxdtInbgZDZD',
	'app_secret' => 'ac2d2709515cd77dc9eccfdc6f0665e1',
    'verification'=>'yosaton_tungmanelatkul',
]
];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create an instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

// Start listening
$botman->listen();