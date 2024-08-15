<?php

namespace AddOns\Tenancy\Domain\Queries;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Tenancy\Domain\Models\AddonModel;

class AllAddOnsQuerySql extends GenericQuerySql implements IAddOnQuery
{
    public function __construct(MySQLLink $link)
    {
        $model = new AddonModel();
        parent::__construct($link, $model);
    }
}
