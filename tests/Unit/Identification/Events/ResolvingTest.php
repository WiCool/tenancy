<?php

namespace Tenancy\Tests\Unit\Identification\Events;

use Tenancy\Identification\Events\Resolving;
use Tenancy\Tests\TestCase;

class ResolvingTest extends TestCase
{
    /**
     * @test
     */
    function dispatches_event()
    {
        $this->expectsEvents(Resolving::class);

        $this->assertFalse($this->environment->isIdentified());

        $this->environment->getTenant();

        $this->assertTrue($this->environment->isIdentified());
    }
}
