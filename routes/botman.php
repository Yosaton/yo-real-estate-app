<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

// $botman->hears('Hi', function ($bot) {
//     $bot->reply('Hello!');
// });

// $botman->hears('what is your name', function ($bot) {
//     $bot->reply('Yosaton');
// });

$botman->hears('call me {name}', function ($bot, $name) {
    $bot->reply('Your name is: '.$name);
    // dd($bot->getMessage()->getPayload());
});

$botman->hears('call me {name} the {adjective}', function ($bot, $name, $adjective) {
    $bot->reply('Hello '.$name.'. You truly are '.$adjective);
});

$botman->hears('Give me details', function ($bot, $name, $adjective) {
    $bot->reply('Sure thing! One second...');
});

$botman->hears('Hello', function ($bot, $name, $adjective) {
    $bot->reply('Hey there!');
});

// $storage = $botman->userStorage();

// dd($storage, "storage");

// $bot->userStorage()->save([
//     'name' => $name
// ]);

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});


$botman->hears('Start conversation', BotManController::class.'@startConversation');
