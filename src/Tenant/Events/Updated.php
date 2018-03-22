<?php

namespace Tenancy\Tenant\Events;

use Tenancy\Identification\Contracts\Tenant;

class Updated
{
    /**
     * @var Tenant
     */
    public $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
}
