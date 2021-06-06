<?php

namespace App\Traits;

/**
 * Trait TableName
 * @package App\Traits
 */
trait TableName
{
    /**
     * @return mixed
     */
    public static function getTableName()
    {
        return (new self())->getTable();
    }
}
