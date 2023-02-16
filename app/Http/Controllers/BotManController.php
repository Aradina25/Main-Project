<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\tblbook;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {

         $botman = app('botman');
         $botman->hears('{message}', function($botman, $message) {
          if ($message == 'next')
          {
            $this->option($botman);
          }
          else
          {
            $botman->reply("Command not identified!! Type 'next' to continue...");
          }
       });

       $botman->listen();

    }

      /**
       * Place your BotMan logic here.
      */

      public function option($botman)
      {

          $botman->ask('Choose from the following options for service<br> 1. Quote for the day <br> 2. Top 3 books on chart <br> 3. Rating of any books <br> 4. File a complaint <br>(Only enter the option number)', function(Answer $answer) {
          $opt = $answer->getText();
          if($opt == '1'){
            $quote = Inspiring::quote();
            $this->say($quote);
          }
          elseif($opt== '2')
          {
            $book = tblbook::where('title','LIKE','%'."".'%')->orderBy('rating','DESC')->get();
            $toplist="<b><u>Top 3 list from chart</u></b><br>";
            $x = 1;
            foreach($book as $b){
              $toplist = $toplist.$b->title." - <b>".$b->rating."/5</b><br>";
              $x++;
              if($x==4) break;
            }
            $this->say($toplist);
          }
          elseif($opt == '3')
          {
            $book = tblbook::where('title','LIKE','%'."".'%')->orderBy('rating','DESC')->get();
            $booklist = "";
            $i=1;
            foreach($book as $b){
                $booklist = $booklist.$b->title." - <b>".$b->rating."/5</b><br>";
                $i++;
            }
            $this->say($booklist);
          }
          elseif($opt =='4')
          {
            $this->say("Send a mail to <a href='mailto:customarcareblounge@gmail.com'>customarcareblounge@gmail.com</a>");
          }
          else
          {
            $this->say("Wrong choice!! Type 'next' to continue");
          }
        });

      }
}