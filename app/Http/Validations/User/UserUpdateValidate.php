<?php

namespace App\Http\Validations\User;

use App\Http\Validations\Validation;

class UserUpdateValidate extends Validation
{
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'min:3',
                'max:255',
            ]
        ];
    }
}
