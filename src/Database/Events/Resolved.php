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
use Tenancy\Identification\Contracts\IdentifiableAsTenant;

class Resolved
{
    /**
     * @var IdentifiableAsTenant
     */
    public $tenant;
    /**
     * @var ProvidesDatabaseDriver
     */
    public $provider;

    public function __construct(IdentifiableAsTenant $tenant, ProvidesDatabaseDriver &$provider = null)
    {
        $this->tenant = $tenant;
        $this->provider = &$provider;
    }
}
