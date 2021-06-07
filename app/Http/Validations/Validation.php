<?php

namespace App\Http\Validations;

use App\Components\Constants\ResultCode;
use App\Traits\Response\Response;
use Illuminate\Http\Request;
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
     * @param Request $request
     *
     * @throws ValidationException
     */
    public static function validate(Request $request)
    {
        $validator = Validator::make($request->post(), static::rules());

        if ($validator->fails()) {
            $response = static::response($validator->getMessageBag(), ResultCode::VALIDATION_ERROR);
            throw (new ValidationException($validator, $response));
        }
    }
}

