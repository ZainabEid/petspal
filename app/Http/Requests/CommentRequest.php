<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ApiRequest;
use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentRequest extends FormRequest
{
    use ApiRequest;
   
    public function authorize()
    {
        // comment author can update the comment
        if( request()->is('api/*') ){

            if(request()->route('comment')){
    
                $comment = Comment::findOrFail(request()->route('comment')->id);
                return Auth::id() === $comment->author->id ;
                
            }
        }
        return true;
    }

    
    public function rules()
    {
        return [
            'body' => 'required'
        ];
    }
    
   
}
