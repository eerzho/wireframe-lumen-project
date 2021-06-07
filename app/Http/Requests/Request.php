<?php

namespace App\Http\Requests;

use App\Components\Constants\ResultCode;
use App\Traits\Response\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Urameshibr\Requests\FormRequest;

/**
 * Class Request
 * @package App\Http\Requests
 */
class Request extends FormRequest
{
    use Response;

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = $this->response($validator->errors(), ResultCode::VALIDATION_ERROR);
        throw (new ValidationException($validator, $response));
    }
}
