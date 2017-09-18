<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SwapProduct extends Mailable
{
    use Queueable, SerializesModels;

    private $orderNotes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderNotes)
    {
        $this->orderNotes = $orderNotes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('baloshopat@gmail.com')->markdown('emails.swaps.recommed')->with(['note' => $this->orderNotes]);
    }
}
