<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customerEmail;
    public $customerName;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, string $customerEmail, string $customerName)
    {
        $this->order = $order;
        $this->customerEmail = $customerEmail;
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Order Confirmation - {$this->order->order_number}")
                    ->to($this->customerEmail, $this->customerName)
                    ->view('emails.orders.placed')
                    ->text('emails.orders.placed-text');
    }
}
