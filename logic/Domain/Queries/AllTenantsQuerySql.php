<?php

namespace AddOns\Tenancy\Domain\Queries;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Tenancy\Domain\Models\TenantModel;

class AllTenantsQuerySql extends GenericQuerySql implements ITenantQuery
{
    public function __construct(MySQLLink $link)
    {
        $model = new TenantModel();
        parent::__construct($link, $model);
    }
}
