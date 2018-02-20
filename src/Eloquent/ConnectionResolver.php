<?php

namespace Tenancy\Eloquent;

use Illuminate\Database\ConnectionResolverInterface;
use Tenancy\Database\DatabaseResolver;
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

    public function __construct(DatabaseResolver $manager, Environment $environment, $resolver)
    {
        $this->manager = $manager;
        $this->environment = $environment;
        $this->resolver = $resolver;
    }

    /**
     * Get a database connection instance.
     *
     * @param  string $name
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection($name = null)
    {
        if ($name === config('tenancy.database.tenant-connection-name')) {
            $provider = $this->manager->__invoke($this->environment->getTenant(), $name);

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
