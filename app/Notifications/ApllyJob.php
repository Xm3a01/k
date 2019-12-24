<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApllyJob extends Notification
{
    use Queueable;

    public $job;
    public $sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender,$job)
    {
        $this->job = $job;
        $this->sender = $sender;
        $job->load('owner');
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->sender->id,
            'notfy_description' => 'المستخدم ' .$this->sender->ar_name.' قام بطلب الوظيفه '.$this->job->ar_sub_special,
            'company_name' => $this->job->owner->company_name,
            'photo' => $this->sender->avatar,
            'Job_special' => $this->job->special,
            'Job_sub_special' => $this->job->sub_special,
            'special' => $this->sender->special,
            'sub_special' => $this->sender->sub_special,
            'sender_id' => $this->job->owner->id,
            'job_id' => $this->job->id
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
