<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderApprovalRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $writer;
    public $admin;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($writer, $admin, $order)
    {
        $this->writer = $writer;
        $this->order = $order;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order_approval_rejected');
    }
}
