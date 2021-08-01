<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyAccount extends Notification
{
    use Queueable;

  
    public function __construct()
    {
        //
    }

   
    public function via($notifiable)
    {
        return ['mail'];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your Code is.'.$notifiable->code)
                    ->line('The Code Will Expires in 10 minutes!')
                    ->line('Thank you for using our application!');
    }

   
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
