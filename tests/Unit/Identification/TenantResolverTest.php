<?php

namespace Tenancy\Tests\Unit\Identification;

use Illuminate\Contracts\Events\Dispatcher;
use Tenancy\Identification\Contracts\ResolvesTenants;
use Tenancy\Identification\Events\Resolving;
use Tenancy\Tests\Models\Tenant;
use Tenancy\Tests\TestCase;

class TenantResolverTest extends TestCase
{
    /**
     * @var ResolvesTenants
     */
    protected $resolver;
    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @var Tenant
     */
    protected $tenant;

    protected function afterSetUp()
    {
        $this->resolver = $this->app->make(ResolvesTenants::class);
        $this->events = $this->app->make(Dispatcher::class);
        $this->tenant = factory(Tenant::class)->create();
    }

    /**
     * @test
     */
    function returns_tenant_when_resolved()
    {
        $this->events->listen(Resolving::class, function ($event) {
            return $this->tenant;
        });

        /** @var Tenant $tenant */
        $tenant = $this->resolver();

        $this->assertEquals($this->tenant->getTenantIdentifier(), $tenant->getTenantIdentifier());
    }
}
