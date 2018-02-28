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

namespace Tenancy\Providers\Provides;

use Illuminate\Database\ConnectionResolverInterface;
use Tenancy\Eloquent\ConnectionResolver;

trait ProvidesEloquentConnections
{
    protected function bootProvidesEloquentConnections()
    {
        $this->app->extend(ConnectionResolverInterface::class, function ($resolver) {
            return $this->app->makeWith(ConnectionResolver::class, compact('resolver'));
        });
    }
}
