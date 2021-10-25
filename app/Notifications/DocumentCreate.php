<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\DocumentCreate as Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentCreate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $document;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($document, $user)
    {
        $this->document = $document;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = [];
        if($notifiable->settings['notifications_by_email']) $via[] = 'mail';
        if($notifiable->settings['notifications_by_websocket']) $via[] = 'database';

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = 'Документ создан';
        return (new Mailable($notifiable, $this->document, $this->user))->subject($subject)->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'text' => 'Пользователь ' . $this->user->name . ' создал документ ' . $this->document->name
        ];
    }
}
