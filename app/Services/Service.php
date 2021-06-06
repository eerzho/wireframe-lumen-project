<?php

namespace App\Services;

/**
 * Class Service
 * @package App\Services
 */
abstract class Service
{
    abstract public function run(): bool;
}
