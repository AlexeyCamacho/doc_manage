<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notifications extends Mailable
{
    use Queueable, SerializesModels;

    protected $document;
    protected $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable, $document)
    {
        $this->notifiable = $notifiable;
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.Notification')->with([
            'name' => $this->notifiable->name,
            'text' => 'Пользователь создал документ. <br>
            Название: ' . $this->document->name .
            '<br>Дедлайн: ' .  $this->document->deadline
        ]);
    }
}
