<?php

namespace App\Exceptions;

use App\Traits\Response;
use Illuminate\Http\JsonResponse;

/**
 * Class Exception
 * @package App\Exceptions
 */
abstract class Exception extends \Exception
{
    use Response;

    /**
     * @param $request
     *
     * @return JsonResponse
     */
    abstract public function render($request): JsonResponse;
}
