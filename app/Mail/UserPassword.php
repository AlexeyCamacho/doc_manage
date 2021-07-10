<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name_user;
    public $login_user;
    public $password_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name_user, $login_user, $password_user)
    {
        $this->name_user = $name_user;
        $this->login_user = $login_user;
        $this->password_user = $password_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password')->with([
            'name_user' => $this->name_user,
            'login_user' => $this->login_user,
            'password_user' => $this->password_user,
        ]);
    }
}
