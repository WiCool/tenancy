<?php

namespace Tenancy\Database\Contracts;

use Illuminate\Database\ConnectionInterface;

interface ProvidesDatabaseDriver
{
    public function connection(): ConnectionInterface;
}
