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

namespace Tenancy\Identification\Events;

use Tenancy\Contracts\IdentifiableAsTenant;

class Resolved
{
    /**
     * @var IdentifiableAsTenant|null
     */
    public $tenant;

    public function __construct(IdentifiableAsTenant &$tenant = null)
    {
        $this->tenant = &$tenant;
    }
}
