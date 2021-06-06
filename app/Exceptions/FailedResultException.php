<?php

namespace App\Exceptions;

use App\Components\Constants\ResultCode;
use Illuminate\Http\JsonResponse;

/**
 * Class FailedResultException
 * @package App\Exceptions
 */
class FailedResultException extends Exception
{
    /**
     * @param $request
     *
     * @return JsonResponse
     */
    public function render($request): JsonResponse
    {
        return self::response([], ResultCode::FAILED_RESULT, $this->getMessage());
    }
}
