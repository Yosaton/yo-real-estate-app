<?php
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Commands\AddStartButtonPayload;
use BotMan\Drivers\Facebook\Commands\AddGreetingText;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
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
            $this->say('Great!');
            $this->askPrequalified();
        }
    });
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

        $this->askPriceRange();
            
        });
    }

    public function askPriceRange()
    {
        $question = Question::create('What price range are you looking in?')
            ->fallback('Unable to funnel lead')
            ->callbackId('lead_funneled')
            ->addButtons([
                Button::create('$200k - $400k')->value('$200k - $400k'),
                Button::create('$400k - $600k')->value('$400k - $600k'),
                Button::create('$600k +')->value('$600k +'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText(); 
            }

        $this->say('Great!');
        $this->confirmEmail();  
        });
    }

    public function confirmEmail()
    {
        $question = Question::create('Is this your email? (insert email)' )
            ->fallback('Unable to funnel lead')
            ->callbackId('lead_funneled')
            ->addButtons([
                Button::create('Yes')->value('Yes'),
                Button::create('No')->value('No'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText(); 
            }

        $this->confirmPhoneNumber();  
        });
    }

    public function confirmPhoneNumber()
    {
        $question = Question::create('Is this your phone number? (phone number)' )
            ->fallback('Unable to funnel lead')
            ->callbackId('lead_funneled')
            ->addButtons([
                Button::create('Yes')->value('Yes'),
                Button::create('No')->value('No'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText(); 
            }

        $this->say('Sounds good... I will be in in touch.');
        });
    }


    public function run()
    {
        // This will be called immediately
        $this->welcome();
    }
}
  


$botman->hears('Start conversation', BotManController::class.'@startConversation');
