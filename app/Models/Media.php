<?php

namespace App\Models;

use Optix\Media\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    public static function boot()
    {
        parent::boot();
        static::deleted(function ($model){
            $model->filesystem()->deleteDirectory(
                $model->getDirectory()
            );
        });
    }
}