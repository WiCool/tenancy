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

namespace Tenancy\Eloquent;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\ConnectionResolverInterface;
use Tenancy\Database\DatabaseResolver;
use Tenancy\Database\Events\Drivers\Configuring;
use Tenancy\Environment;

class ConnectionResolver implements ConnectionResolverInterface
{
    /**
     * @var Environment
     */
    private $environment;
    /**
     * @var DatabaseResolver
     */
    private $manager;
    /**
     * @var ConnectionResolverInterface
     */
    private $resolver;
    /**
     * @var Dispatcher
     */
    private $events;

    public function __construct(DatabaseResolver $manager, Environment $environment, $resolver, Dispatcher $events)
    {
        $this->manager = $manager;
        $this->environment = $environment;
        $this->resolver = $resolver;
        $this->events = $events;
    }

    /**
     * Get a database connection instance.
     *
     * @param  string $name
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection($name = null)
    {
        /** @var $tenant \Tenancy\Identification\Contracts\Tenant */
        if ($name === config('tenancy.database.tenant-connection-name') &&
            $tenant = $this->environment->getTenant() &&
            // Only invoke the database manager to (re-) create the connection.
            // Otherwise just allow a pass through.
            config("database.connections.$name.uuid") !== $tenant->getTenantKey()) {

            $provider = $this->manager->__invoke($tenant, $name);

            $configuration = $provider->configure($tenant);

            $configuration['uuid'] = $tenant->getTenantKey();

            $this->events->dispatch(new Configuring($name, $configuration, $provider));

            config(["database.connections.$name" => $configuration]);

            return $provider->connection();
        }

        return $this->resolver->connection($name);
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        if (config('tenancy.database.models-default-to-tenant-connection')) {
            return config('tenancy.database.tenant-connection-name');
        }

        return $this->resolver->getDefaultConnection();
    }

    /**
     * Set the default connection name.
     *
     * @param  string $name
     * @return void
     */
    public function setDefaultConnection($name)
    {
        return $this->resolver->setDefaultConnection($name);
    }
}
