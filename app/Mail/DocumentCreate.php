<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentCreate extends Mailable
{
    use Queueable, SerializesModels;

    protected $document;
    protected $notifiable;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable, $document, $user)
    {
        $this->notifiable = $notifiable;
        $this->document = $document;
        $this->user = $user;
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
            'text' => 'Пользователь ' . $this->user->name . ' создал документ.<br>'.
            'Название: ' . $this->document->name . '<br>' .
            'Дедлайн: ' .  ($this->document->deadline ? $this->document->deadline : 'не определен')
        ]);
    }
}
