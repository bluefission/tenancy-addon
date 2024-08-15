<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;

interface ILogRepository extends IGenericRepository {
    public function findByTenantAndType($tenantId, $logType);
}