<?php

namespace Tenancy\Tests\Concerns;

use Tenancy\Tests\Mocks\Tenant;

trait InteractsWithTenants
{
    protected function tenant(): Tenant
    {
        return factory(Tenant::class)->create();
    }
}
