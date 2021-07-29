<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Post;
use App\Repositories\Eloquent\Contracts\TagInterface;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository implements TagInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    
}

