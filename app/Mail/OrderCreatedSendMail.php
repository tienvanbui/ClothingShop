<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedSendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $useName;
    protected $products;
    protected $subjectMail = 'Confirm your order';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $products)
    {
        $this->userName = $userName;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.orders.orderCreated')
            ->subject($this->subjectMail)
            ->with('userName', $this->userName)
            ->with('products', $this->products);
    }
}
