<?php

namespace Tenancy\Tests\Unit\Identification\Events;

use Tenancy\Identification\Events\Configuring;
use Tenancy\Tests\TestCase;

class ConfiguringTest extends TestCase
{
    /**
     * @test
     */
    function dispatches_event()
    {
        $this->expectsEvents(Configuring::class);

        $this->environment->getTenant();
    }
}
