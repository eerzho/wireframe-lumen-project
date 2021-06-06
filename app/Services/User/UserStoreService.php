<?php

namespace App\Services\User;

use App\Components\Request\DataTransfer;
use App\Models\User\User;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserStoreService
 * @property User         $user
 * @property DataTransfer $request
 * @package App\Services\User
 */
class UserStoreService extends Service
{
    private User $user;
    private DataTransfer $request;

    /**
     * UserStoreService constructor.
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
        $this->user->name = $this->request->post('name');
        $this->user->email = $this->request->post('email');
        $this->user->password = Hash::make($this->request->post('password'));

        return $this->user->save();
    }
}
