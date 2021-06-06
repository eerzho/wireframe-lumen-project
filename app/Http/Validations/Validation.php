<?php

namespace App\Http\Validations;

use App\Components\Constants\ResultCode;
use App\Traits\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class Validation
 * @package App\Http\Validations
 */
abstract class Validation
{
    use Response;

    /**
     * @return array
     */
    abstract public static function rules(): array;

    /**
     * @param array $data
     *
     * @throws ValidationException
     */
    public static function validate(array $data)
    {
        $validator = Validator::make($data, static::rules());

        if ($validator->fails()) {
            $response = static::response($validator->getMessageBag(), ResultCode::VALIDATION_ERROR);
            throw (new ValidationException($validator, $response));
        }
    }
}

