<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $random_str;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($random_str)
    {
        $this->random_str = $random_str;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password')->with([
            'random_str' => $this->random_str,
        ]);
    }
}
