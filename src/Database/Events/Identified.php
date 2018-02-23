<?php

/*
 * This file is part of the tenancy/tenancy package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see http://laravel-tenancy.com
 * @see https://github.com/tenancy
 */

namespace Tenancy\Database\Events;

use Tenancy\Database\Contracts\ProvidesDatabaseDriver;
use Tenancy\Identification\Contracts\Tenant;

class Identified
{
    /**
     * @var Tenant
     */
    public $tenant;
    /**
     * @var ProvidesDatabaseDriver
     */
    public $provider;
    /**
     * @var string
     */
    public $connection;

    public function __construct(Tenant $tenant, string $connection = null, ProvidesDatabaseDriver &$provider)
    {
        $this->tenant = $tenant;
        $this->provider = &$provider;
        $this->connection = $connection;
    }
}