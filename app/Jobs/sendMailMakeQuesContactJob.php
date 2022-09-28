<?php

namespace App\Jobs;

use App\Mail\ContactMakeQuestionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMailMakeQuesContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $fromEmail;
    protected $toMail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $fromEmail, $toMail)
    {
        $this->message = $message;
        $this->fromEmail = $fromEmail;
        $this->toMail = $toMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->toMail)->send(new ContactMakeQuestionMail($this->message, $this->fromEmail));
    }
}
