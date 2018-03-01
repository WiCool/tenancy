<?php

namespace Tenancy\Tests\Concerns;

use Illuminate\Contracts\Events\Dispatcher;
use Mockery;

/**
 * Trait MocksApplicationServices
 *
 * @package Tenancy\Tests\Concerns
 *
 * @info This trait has been overloaded in order to allow us to catch the "until" methods
 *       of the event dispatcher as well.
 */
trait MocksApplicationServices
{
    /**
     * Mock the event dispatcher so all events are silenced and collected.
     *
     * @return $this
     */
    protected function withoutEvents()
    {
        $mock = Mockery::mock(Dispatcher::class)->shouldIgnoreMissing();

        $mock->shouldReceive('fire', 'dispatch', 'until')->andReturnUsing(function ($called) {
            $this->firedEvents[] = $called;
        });

        $this->app->instance('events', $mock);

        return $this;
    }
}
