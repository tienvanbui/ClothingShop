<?php

namespace App\Listeners;

use App\Jobs\sendEmailOrderJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendMailToConfirmOrder
{
    protected $user_name = '';
    protected $user_email = '';
    protected $products = [];
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->user_email = $event->user_email;
        $this->user_name = $event->user_name;
        $this->products = $event->products;
        sendEmailOrderJob::dispatch($this->user_name, $this->user_email, $this->products)->onQueue('sendMail');
    }
}
