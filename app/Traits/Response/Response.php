<?php

namespace App\Traits\Response;

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
    public function response($data, int $code = ResultCode::SUCCESS, string $message = null): JsonResponse
    {
        return new JsonResponse([
            'result_code'    => $code,
            'result_message' => $message ?: ResultCode::getMessage()[$code],
            'result_data'    => $data
        ], $code);
    }
}
