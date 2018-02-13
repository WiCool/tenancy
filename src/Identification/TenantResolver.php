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

namespace Tenancy\Identification;

use Illuminate\Contracts\Events\Dispatcher;
use Tenancy\Contracts\IdentifiableAsTenant;

class TenantResolver
{
    /**
     * @var Dispatcher
     */
    protected $events;

    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    public function __invoke(): ?IdentifiableAsTenant
    {
        $tenant = $this->events->until(new Events\Resolving);

        if ($tenant) {
            $this->events->dispatch(new Events\Identified($tenant));
        }

        $this->events->dispatch(new Events\Resolved($tenant));

        return $tenant;
    }
}
