<?php

namespace Tenancy\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant as Contract;

class Tenant extends Model implements Contract
{
    protected $table = 'users';

    use AllowsTenantIdentification;
}
