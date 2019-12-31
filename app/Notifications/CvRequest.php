<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CvRequest extends Notification
{
    use Queueable;

    public $user;
    public $sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $sender)
    {
        $this->user = $user;
        $this->sender = $sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

   
    public function toDatabase($notifiable)
    {
        return  [
            'id' => $this->user->id,
            'notfy_description' => 'صاحب العمل ' .$this->sender->ar_name.' قام بطلب السيره '.$this->user->ar_name,
            'name' => $this->user->ar_name,
            'sub_special' => $this->user->sub_special->ar_name,
            'photo' => $this->sender->avatar,
            'sender_id' => $this->sender->id
        ];
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
            //
        ];
    }
}
