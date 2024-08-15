<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\BlueCore\Domain\Repositories\IGenericRepository;

interface IDatabaseRepository extends IGenericRepository {
    public function findByName($name);
}