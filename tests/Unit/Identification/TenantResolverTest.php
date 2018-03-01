<?php

namespace Tenancy\Tests\Unit\Identification;

use Illuminate\Foundation\Auth\User;
use Tenancy\Identification\Contracts\ResolvesTenants;
use Tenancy\Identification\Events\Resolving;
use Tenancy\Tests\Mocks\Tenant;
use Tenancy\Tests\TestCase;

class TenantResolverTest extends TestCase
{
    /**
     * @var ResolvesTenants
     */
    protected $resolver;

    /**
     * @var Tenant
     */
    protected $tenant;

    protected function afterSetUp()
    {
        $this->resolver = $this->app->make(ResolvesTenants::class);
        $this->tenant = factory(Tenant::class)->create();
    }

    /**
     * @test
     */
    function can_resolve_a_tenant()
    {
        $this->events->listen(Resolving::class, function (Resolving $event) {
            return $this->tenant;
        });

        /** @var Tenant $tenant */
        $tenant = $this->resolver->__invoke();

        $this->assertEquals($this->tenant->getTenantIdentifier(), $tenant->getTenantIdentifier());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    function fails_registering_invalid_model()
    {
        $this->resolver->addModel(User::class);
    }

    /**
     * @test
     */
    function allows_providers_to_match_models()
    {
        $this->events->listen(Resolving::class, function (Resolving $event) {
            $event->models->each(function (string $class) {
                $this->assertEquals(Tenant::class, $class);
            });
        });

        $this->resolver->addModel(Tenant::class);

        $this->resolver->__invoke();
    }
}
