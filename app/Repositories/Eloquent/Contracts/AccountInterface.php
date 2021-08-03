<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Account;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface AccountInterface  extends EloquentInterface
{
    public function __construct(Account $account);
    public function allNormalPaginated(int $pagination=0);
    public function allAdoptionPaginated(int $pagination=0);
    public function updateAvatar( Account $account,$image);
    public function update(int $accountId = null, array $attributes);
    public function switchAccount(Account $account);
    public function deleteOrDeactivate(User $user , Account $account );
   
}