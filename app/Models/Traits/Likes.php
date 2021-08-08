<?php
namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Likes
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like(User $user=null )
    {
        if(! Auth::check() &&  ! $user ){
            return false;
        }

        if( Auth::check() &&  ! $user ){

            $user = User::findOrFail( Auth::id() );
        }

        
        $user = $user->hasLiked( $this) ?  $user->unlike($this) :  $user->like($this) ;

        return $this;
    }
}