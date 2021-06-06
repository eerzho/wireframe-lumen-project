<?php

namespace App\Http\Validations\User;

use App\Http\Validations\Validation;

/**
 * Class UserStoreValidate
 * @package App\Http\Validations\User
 */
class UserStoreValidate extends Validation
{
    /**
     * @return \string[][]
     */
    public static function rules(): array
    {
        return [
            'name'     => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'email'    => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ]
        ];
    }
}
