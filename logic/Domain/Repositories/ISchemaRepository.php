<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;

interface ISchemaRepository extends IGenericRepository {
    public function findByTenantAndName($tenantId, $schemaName);
}