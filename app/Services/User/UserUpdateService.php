<?php

namespace App\Services\User;

use App\Components\Request\DataTransfer;
use App\Models\User\User;
use App\Services\Service;

/**
 * Class UserUpdateService
 * @property User         $user
 * @property DataTransfer $request
 * @package App\Services\User
 */
class UserUpdateService extends Service
{
    private User $user;
    private DataTransfer $request;

    /**
     * UserUpdateService constructor.
     *
     * @param User         $user
     * @param DataTransfer $request
     */
    public function __construct(User $user, DataTransfer $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        $this->user->name = $this->request->get('name');
        $this->user->email = $this->request->get('email');

        return $this->user->save();
    }
}
