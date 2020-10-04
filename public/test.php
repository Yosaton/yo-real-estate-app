<?php 
// header('HTTP/1.1 200 OK');
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
DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

// Create an instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

// Start listening
$botman->listen();




/* GET ALL VARIABLES GET & POST */
// foreach ($_REQUEST AS $key => $value){
//     $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
// }
// $input = file_get_contents("php://input");
// $array = print_r(json_decode($input, true), true);
// file_put_contents('fbmessenger.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
// echo $_REQUEST['hub_challenge'];