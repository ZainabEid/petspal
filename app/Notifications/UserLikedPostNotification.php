<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLikedPostNotification extends Notification
{
    use Queueable;
    
    private  $user;
    private  $post;

    
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

  
    public function toArray($notifiable)
    {
        return [
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'post_thumbnail' => $this->post->thumbnail,
            'title' => 'User Liked Post Notification',
            'body' => $this->user->name.' Liked Your post',
        ];
    }
}
