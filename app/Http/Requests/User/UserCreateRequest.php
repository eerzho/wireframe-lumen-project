<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UserCreateRequest
 * @package App\Http\Requests\User
 */
class UserCreateRequest extends Request
{
    /**
     * @return \string[][]
     */
    public function rules()
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
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ]
        ];
    }
}
