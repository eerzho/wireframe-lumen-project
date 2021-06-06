<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 * @package Database\Seeders\User
 */
class UserSeeder extends Seeder
{

    public function run()
    {
        self::createUser(10);
    }

    public static function createUser(int $num)
    {
        return User::factory($num)->make()->each(function (User $user) {
            $user->save();
        });
    }
}
