<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ApiRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostRequest extends FormRequest
{
    use ApiRequest;
 
    
    public function rules()
    {
        return [
            'body' => 'required|string',    
            'medias' => 'sometimes|required|array|min:1',
            // 'medias.*' => 'mimetypes:image,video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ]; 
    }

    
    
   
}
