<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;

    /**
     * @param $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscription', ['product' => $this->product]);
    }
}
