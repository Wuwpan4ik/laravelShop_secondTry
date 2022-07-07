<?php

namespace App\Mail;

use App\Classes\Basket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $basket;

    /**
     * @param $name
     * @param $basket
     */
    public function __construct($name, Basket $basket)
    {
        $this->name = $name;
        $this->basket = $basket;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $full_sum = $this->basket->getOrder()->calculateFullPrice();
        return $this->view('mail.order_create', ['name' => $this->name, 'full_sum' => $full_sum]);
    }
}
