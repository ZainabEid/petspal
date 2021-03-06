<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowNotification extends Notification
{
    use Queueable;

    private  $user;

    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

   
    public function via($notifiable)
    {
        return ['database'];
    }

   
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

   
    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'user_id' => $this->user->id,
            'title' => 'User Follow Notification',
            'body' => $this->user->name.' has followed you ',
            
        ];
    }
}
