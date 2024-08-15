<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;

interface ITenantRepository extends IGenericRepository {
    public function findByDomain($domain);
}