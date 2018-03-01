<?php

namespace Tenancy\Tests\Unit\Identification\Middleware;

use Illuminate\Http\Request;
use Tenancy\Identification\Middleware\EagerIdentification;
use Tenancy\Tests\TestCase;

class EagerIdentificationTest extends TestCase
{
    /**
     * @test
     */
    function is_eagerly_identifying_tenant()
    {
        $this->assertFalse($this->environment->isIdentified());

        $middleware = new EagerIdentification($this->app);

        $middleware->handle(new Request, function () {});

        $this->assertTrue($this->environment->isIdentified());
    }
}
