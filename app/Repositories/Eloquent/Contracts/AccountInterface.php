<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Account;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface AccountInterface  extends EloquentInterface
{
    public function __construct(Account $account);
    public function updateAvatar( Account $account,$image);
    public function update(int $accountId = null, array $attributes);
   
}