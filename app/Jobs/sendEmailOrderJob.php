<?php

namespace App\Jobs;

use App\Mail\OrderCreatedSendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendEmailOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_name = '';
    protected $user_email = '';
    protected $products = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($user_name, $user_email, $products)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user_email)->send(new OrderCreatedSendMail($this->user_name, $this->products));
    }
}
