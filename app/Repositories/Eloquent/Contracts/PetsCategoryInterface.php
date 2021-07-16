<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\PetsCategory;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface PetsCategoryInterface extends EloquentInterface
{
    public function __construct(PetsCategory $pets_category);
   
}