<?php

namespace AddOns\Tenancy\Domain\Queries;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Tenancy\Domain\Models\DatabaseModel;

class AllDatabasesQuerySql extends GenericQuerySql implements IDatabaseQuery
{
    public function __construct(MySQLLink $link)
    {
        $model = new DatabaseModel();
        parent::__construct($link, $model);
    }
}
