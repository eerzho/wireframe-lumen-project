<?php

namespace App\Traits;

use App\Components\Constants\ResultCode;
use Illuminate\Http\JsonResponse;

/**
 * Trait Response
 * @me
 * @package App\Traits
 */
trait Response
{
    /**
     * @param             $data
     * @param int         $code
     * @param string|null $message
     *
     * @return JsonResponse
     */
    public static function response($data, int $code = ResultCode::SUCCESS, string $message = null): JsonResponse
    {
        return new JsonResponse([
            'result_code'    => $code,
            'result_message' => $message ?: ResultCode::getMessage()[$code],
            'result_data'    => $data
        ], $code);
    }
}
