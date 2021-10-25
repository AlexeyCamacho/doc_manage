<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\DocumentDelete as Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentDelete extends Notification implements ShouldQueue
{
    use Queueable;

    protected $documentName;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($document, $user)
    {
        $this->documentName = $document->name;
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
        $subject = 'Документ удален';
        return (new Mailable($notifiable, $this->documentName, $this->user))->subject($subject)->to($notifiable->email);
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
            'text' => 'Пользователь ' . $this->user->name . ' удалил документ ' . $this->documentName
        ];
    }
}
