<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Clinic;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface ClinicInterface extends EloquentInterface
{
    public function __construct(Clinic $clinic);
    public function create(array $attributes);
    public function update(int $modelId ,  array $attributes);
    public function rate(Clinic $clinic , int $rate , int $user);
   
}