<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $input1 = $this->details['subject'];
        $input2 = $this->details['NoticeData'];
        $input3 = $this->details['StudentData'];
        $message = '';
        $subject = '';
       
            $message = $input2[0]->MESSAGE;
            $subject = $input2[0]->TITLE;
      
       /* echo $subject;
      die;*/
      //  $message = ['msg'=>$message];
        foreach ($input3 as $key => $value) {
            
            $input['email'] = $value->S_EMAIL;
            $input['name'] = $value->STUDENT_NAME;
            $input['subject'] = $subject;
            $input['message'] = $message;
            
            /*Mail::send('email_notice', $message, function($message) use($input){
                $message->to($input['email'], $input['name'])
                    ->subject($input['subject'])
                    ->setBody($input['message'], 'text/html');
            });*/
            Mail::send([], [], function($message) use($input){
                $message->to($input['email'], $input['name'])
                    ->subject($input['subject'])
                    ->setBody($input['message'], 'text/html');
            });
        }
    }
}
