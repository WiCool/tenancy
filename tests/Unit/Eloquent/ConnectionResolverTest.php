<?php

namespace Tenancy\Tests\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Tenancy\Eloquent\ConnectionResolver;
use Tenancy\Tests\Mocks\Tenant;
use Tenancy\Tests\TestCase;

class ConnectionResolverTest extends TestCase
{
    /**
     * @test
     */
    function sets_custom_resolver_on_model()
    {
        $this->assertInstanceOf(ConnectionResolver::class, Model::getConnectionResolver());
    }
    /**
     * @test
     */
    function resolves_tenant_connection_when_defaulted()
    {
        config(['tenancy.database.models-default-to-tenant-connection' => true]);

        $this->assertEquals(
            config('tenancy.database.tenant-connection-name'),
            $this->tenant()->getConnectionName()
        );
    }
}
