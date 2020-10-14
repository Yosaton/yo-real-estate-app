<?php
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Commands\AddStartButtonPayload;
use BotMan\Drivers\Facebook\Commands\AddGreetingText;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
// use BotMan\BotMan\Messages\Incoming\Button;
// use BotMan\BotMan\Messages\Incoming\Question;

use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;


$botman = resolve('botman');

// $botman->hears('Hi', function ($bot) {
//     $bot->typesAndWaits(2);
//     $bot->reply('Hello!');
// });



$botman->hears('Hello', function($bot) {
    $bot->startConversation(new OnboardingConversation);
  });
  
  
  class OnboardingConversation extends Conversation
  {
      protected $firstname;
  
      protected $email;

      public function askForDatabase()
{
    $question = Question::create('Do you need a database?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Of course')->value('yes'),
            Button::create('Hell no!')->value('no'),
        ]);

    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
        }
    });
}
  
      public function askFirstname()
      {
          $this->ask('Hello! What is your firstname?', function(Answer $answer) {
              // Save result
              $this->firstname = $answer->getText();
  
              $this->say('Nice to meet you '.$this->firstname);
              $this->askEmail();
          });
      }
  
      public function askEmail()
      {
          $this->ask('One more thing - what is your email?', function(Answer $answer) {
              // Save result
              $this->email = $answer->getText();
  
              $this->say('Great - that is all we need, '.$this->firstname);
          });
      }
  
      public function run()
      {
          // This will be called immediately
          $this->askForDatabase();
      }
  }
  


// $botman->hears('GET_STARTED', function ($bot) {
// 	$bot->reply(ButtonTemplate::create('hello?')
// 		->addButton(ElementButton::create('Button1')->type('postback')->payload('https://botman.io'))
// 		->addButton(ElementButton::create('Button2')->url('https://test.io'))
// 	);
// });

// $botman->hears('Hello BotMan!', function($bot) {
//     $bot->reply('Hello!');
//     $bot->ask('Whats your name?', function($answer, $bot) {
//         $bot->say('Welcome '.$answer->getText()); //this never works
//     });
// });

// $botman->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
// 	->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
// 	->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
// );

// $botman->hears('GET_STARTED', function ($bot) {
//     $bot->typesAndWaits(1);
//     $bot->reply(ButtonTemplate::create('hello?')
//         ->addButton(ElementButton::create('Button1')->type('postback')->payload('https://botman.io'))
//         ->addButton(ElementButton::create('Button2')->url('https://test.io'))
//     );
// });

// $botman->hears('what is your name', function ($bot) {
//     $bot->reply('Yosaton');
// });

// $botman->hears('Hello', function (BotMan $bot) {
//     $bot->reply('Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:');
// });
    // ->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'));

// $botman->hears('call me {name}', function ($bot, $name) {
//     $bot->reply('Your name is: '.$name);
//     // dd($bot->getMessage()->getPayload());
// });

// $botman->hears('keyword', function (BotMan $bot) {
//     $bot->reply("Tell me more!");
// });

// $botman->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
// 	->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
// 	->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
// );

// $botman->hears('call me {name} the {adjective}', function ($bot, $name, $adjective) {
//     $bot->reply('Hello '.$name.'. You truly are '.$adjective);
// });

// $botman->hears('Give me details', function ($bot, $name, $adjective) {
//     $bot->reply('Sure thing! One second...');
// });

// $botman->hears('Hello', function ($bot, $name, $adjective) {
//     $bot->reply('Hey there!');
// });

// $storage = $botman->userStorage();

// dd($storage, "storage");

// $bot->userStorage()->save([
//     'name' => $name
// ]);

// $botman->fallback(function($bot) {
//     $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
// });


$botman->hears('Start conversation', BotManController::class.'@startConversation');
