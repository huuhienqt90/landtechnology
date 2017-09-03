<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    private $userRepositories;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userRepositories)
    {
        $this->userRepositories = $userRepositories;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('baloshopat@gmail.com')->markdown('emails.register.complete')->with(['confirm_code' => $this->userRepositories]);
    }
}
