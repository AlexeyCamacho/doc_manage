<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentDelete extends Mailable
{
    use Queueable, SerializesModels;

    protected $documentName;
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
        $this->documentName = $document;
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
            'text' => 'Пользователь ' . $this->user->name . ' удалил документ.<br>'.
            'Название: ' . $this->documentName
        ]);
    }
}
