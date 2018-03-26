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

namespace Tenancy\Database\Listeners;

use Tenancy\Database\DatabaseResolver;
use Tenancy\Environment;

abstract class DatabaseMutation
{
    /**
     * @var null|\Tenancy\Database\Contracts\ProvidesDatabase
     */
    protected $driver;

    public function __construct(DatabaseResolver $resolver, Environment $environment)
    {
        $this->driver = $resolver->__invoke($environment->getTenant());
    }
}
