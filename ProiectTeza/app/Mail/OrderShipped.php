<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public $order;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->view('emails.orders.shipped');
                    // ->with([
                    //     'orderName' => $this->order->name,
                    //     'orderPrice' => $this->order->price,
                    // ]);
    }
}
