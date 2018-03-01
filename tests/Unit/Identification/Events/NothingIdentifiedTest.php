<?php

namespace Tenancy\Tests\Unit\Identification\Events;

use Tenancy\Identification\Events\NothingIdentified;
use Tenancy\Tests\TestCase;

class NothingIdentifiedTest extends TestCase
{
    /**
     * @test
     */
    function dispatches_event()
    {
        $this->expectsEvents(NothingIdentified::class);

        $this->environment->getTenant();
    }
}
