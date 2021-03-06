<?php

namespace App\Models;

use App\Traits\ScopePaginate\ScopePaginate;

/**
 * Class Model
 * @property int $id
 * @property     $created_at
 * @property     $updated_at
 * @package App\Models
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use ScopePaginate;
}
