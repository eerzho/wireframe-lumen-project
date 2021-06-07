<?php

namespace App\Http\Controllers;

use App\Traits\Response\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use Response;
}
