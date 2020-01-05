<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobAccept extends Notification
{
    use Queueable;

    public $job;
    public $sender;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job  , $sender)
    {
        $this->job = $job;
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
            // 'id'=> $this->sender->id,
            'notfy_description' =>'صاحب العمل  '.$this->sender->ar_name.'  قام بطلب اضافة وظيفه '.$this->job->sub_special,
            'yearsOfExper' => $this->job->experinse,
            'role_id' => $this->job->role_id,
            'country_id' => $this->job->country_id,
            'city_id' => $this->job->city_id,
            'special_id' => $this->job->special_id,
            'sub_special_id' => $this->job->sub_special_id,
            'level' => $this->job->level,
            'status' => $this->job->status,
            'selary' => $this->job->selary,
            'description' => $this->job->description,
            'ar_description' => $this->job->ar_description,
            'sender_id' => $this->sender->id,
            'photo' =>  $this->sender->avatar,
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
