<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\Repository;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModel(): string
    {
        return User::class;
    }

    /**
     * @param $name
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getByName($name)
    {
        return $this->table()->where('name', 'LIKE', '%' . $name . '%')->first();
    }
}
