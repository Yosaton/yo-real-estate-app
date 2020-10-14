<?php

require '../vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Commands\AddStartButtonPayload;
use BotMan\Drivers\Facebook\Commands\AddGreetingText;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;



// use Illuminate\Config;
// use Config;

// $facebook_token = getenv("FACEBOOK_TOKEN");
// $facebook_app_secret = getenv("FACEBOOK_APP_SECRET");
// $facebook_verification = getenv("FACEBOOK_VERIFICATION");

// dd($facebook_token,"facebook token");
// dd($facebook_verification,"facebook_verification");
// dd($facebook_app_secret,"facebook_app_secret");

$FACEBOOK_TOKEN="EAAE3LgC5qc0BAAC6xz5hheZAsUfNgvSZAPsrpzQW9zOXMinvZAtcFmYZA2b5kQIqMZAB12Cp3GZCg6tvWojs7H51Kl5BHdMdAx4XzLhiOyeB4g65sY8iMIZCHTIvauy3ZBnZAul4lcZBWjZBimDeBi1tIbakkB7aaQtDPQZCZABLhUgX0ZBQZDZD";
$FACEBOOK_VERIFICATION="abc_123";
$FACEBOOK_APP_SECRET="ac2d2709515cd77dc9eccfdc6f0665e1";

// $pop = Config::get('services.facebook.facebook_token');
// $pop = config('services.facebook.facebook_token');

// Config::get('services.facebook.facebook_app_secret');
// Config::get('services.facebook.facebook_verification');


$config = [
  'facebook' => [
  	'token' => $FACEBOOK_TOKEN,
	  'app_secret' => $FACEBOOK_APP_SECRET,
    'verification'=>$FACEBOOK_VERIFICATION,
  ]
];


// session_start();

// $var_value = $_REQUEST['varname'];




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

// $botman->hears('', function (BotMan $bot) {
//   $bot->reply('Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:')
//   ->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'));
// });

// $botman->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
// 	->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
// 	->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
// );

// Start listening
$botman->listen();