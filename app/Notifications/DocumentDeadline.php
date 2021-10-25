<?php

namespace App\Notifications;

use App\Models\Permission;
use Illuminate\Bus\Queueable;
use App\Mail\DocumentDeadline as Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentDeadline extends Notification implements ShouldQueue
{
    use Queueable;

    protected $DocumentDeadlineCount = false;
    protected $AllDocuments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        if($notifiable->hasPermissionTo(Permission::firstWhere('slug', 'documents-notifications'))) {
            $this->DocumentDeadlineCount = true;
        }
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
        $subject = 'Дедлайн просрочен';
        return (new Mailable($notifiable))->subject($subject)->to($notifiable->email);
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
            'text' => ($notifiable->hasPermissionTo(Permission::firstWhere('slug', 'documents-notifications')) ? 'У вас ' : 'В системе') .
            'имеется' . . 'просроченных документов.'
        ];
    }
}
