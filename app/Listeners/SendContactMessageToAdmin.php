<?php

namespace App\Listeners;

use App\Jobs\sendMailMakeQuesContactJob;
use App\Mail\ContactMakeQuestionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;

class SendContactMessageToAdmin
{

    protected $fromMail;
    protected $message;
    protected $toMail;
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->fromMail = $event->fromEmail;
        $this->message = $event->message;
        $this->toMail = $event->toMail;
        sendMailMakeQuesContactJob::dispatch($this->message, $this->fromMail, $this->toMail)->onQueue('sendMail');
    }
}
