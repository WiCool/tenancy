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

namespace Tenancy\Database\Events\Drivers;

use Tenancy\Database\Contracts\ProvidesDatabaseDriver;

class Configuring
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $configuration;
    /**
     * @var ProvidesDatabaseDriver
     */
    public $provider;

    public function __construct(string $name, array &$configuration, ProvidesDatabaseDriver $provider)
    {
        $this->name = $name;
        $this->configuration = &$configuration;
        $this->provider = $provider;
    }
}
