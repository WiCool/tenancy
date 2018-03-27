<?php

namespace Tenancy\Database\Listeners;

use Tenancy\Tenant\Events\Created;

class AutoCreation extends DatabaseMutation
{
    public function handle(Created $created): array
    {
        if ($this->driver && config('tenancy.db.auto-create')) {
            return $this->driver->create($created->tenant);
        }

        return [];
    }
}
