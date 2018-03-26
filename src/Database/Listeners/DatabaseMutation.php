<?php

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
