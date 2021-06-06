<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class ExampleListener
 * @package App\Listeners
 */
class ExampleListener
{
    /**
     * ExampleListener constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ExampleEvent $event
     */
    public function handle(ExampleEvent $event)
    {
        //
    }
}
