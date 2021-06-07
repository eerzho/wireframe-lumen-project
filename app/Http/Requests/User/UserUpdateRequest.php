<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UserUpdateRequest
 * @package App\Http\Requests\User
 */
class UserUpdateRequest extends Request
{
    /**
     * @return array
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
                Rule::unique('users', 'email')->ignore($this->segment(2))
            ]
        ];
    }
}
