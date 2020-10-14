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
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;





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


$botman->hears('Hello', function($bot) {
  $bot->startConversation(new OnboardingConversation);
});


class OnboardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function welcome()
{
    $question = Question::create('Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:')
        ->fallback('Unable to funnel lead')
        ->callbackId('lead_funneled')
        ->addButtons([
            Button::create('1-3 months')->value('1-3 months'),
            Button::create('3-6 months')->value('3-6 months'),
            Button::create('6 months +')->value('6 months +'),
        ]);

    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 1-3 monts, 3-6 months, or 6 months +
            $selectedText = $answer->getText(); // will be either 1-3 monts, 3-6 months, or 6 months +
        }

        
      });
    $this->say('Great!');
    $this->askPrequalified();
}

public function askPrequalified()
{
    $question = Question::create('Have you been prequalified by a mortgage loan officer yet?')
        ->fallback('Unable to funnel lead')
        ->callbackId('lead_funneled')
        ->addButtons([
            Button::create('Yes')->value('yes'),
            Button::create('No')->value('no'),
        ]);

    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either Yes or No
            $selectedText = $answer->getText(); // will be either yes or no
        }

    $this->say('Woohoo!');
    // $this->askPrequalified();
        
    });
}




    // public function askFirstname()
    // {
    //     $this->ask('Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:', function(Answer $answer) {
    //         // Save result
    //         $this->firstname = $answer->getText();

    //         $this->say('Nice to meet you '.$this->firstname);
    //         $this->askEmail();
    //     });
    // }

    // public function askEmail()
    // {
    //     $this->ask('One more thing - what is your email?', function(Answer $answer) {
    //         // Save result
    //         $this->email = $answer->getText();

    //         $this->say('Great - that is all we need, '.$this->firstname);
    //     });
    // }

    public function run()
    {
        // This will be called immediately
        $this->welcome();
    }
}


// $botman->hears('hello', function ($bot) {
// 	$bot->reply(ButtonTemplate::create('Welcome to 123 Main Street Bot - I see you are looking to purchase a home.  Are you looking to buy in:')
// 		->addButton(ElementButton::create('1-3 months')->type('postback')->payload('https://botman.io'))
//     ->addButton(ElementButton::create('3-6 months')->url('https://test.io'))
//     ->addButton(ElementButton::create('6 months +')->url('https://test.io'))
//   );
// });

// $botman->hears('1-3 months', function ($bot) {
// 	$bot->reply(ButtonTemplate::create('Great - Have you been prequalified by a mortgage loan officer yet?')
// 		->addButton(ElementButton::create('Yes')->type('postback')->payload('https://botman.io'))
//     ->addButton(ElementButton::create('No')->url('https://test.io'))
//   );
// });

// $botman->hears('Yes?', function ($bot) {
// 	$bot->reply(ButtonTemplate::create('What price range are you looking in?')
// 		->addButton(ElementButton::create('$200k - $400k')->type('postback')->payload('https://botman.io'))
//     ->addButton(ElementButton::create('$400k - $600k')->url('https://test.io'))
//     ->addButton(ElementButton::create('$600k +')->url('https://test.io'))

//   );
// });




// Start listening
$botman->listen();