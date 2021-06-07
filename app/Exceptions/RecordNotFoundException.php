<?php

namespace App\Exceptions;

use App\Components\Constants\ResultCode;
use Illuminate\Http\JsonResponse;

/**
 * Class RecordNotFoundException
 * @package App\Exceptions
 */
class RecordNotFoundException extends Exception
{
    /**
     * @param $request
     *
     * @return JsonResponse
     */
    public function render($request): JsonResponse
    {
        return $this->response([], ResultCode::NOT_FOUND, $this->getMessage());
    }
}
