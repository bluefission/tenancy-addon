<?php

namespace AddOns\Tenancy\Domain\Queries;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Domain\Queries\GenericQuerySql;
use AddOns\Tenancy\Domain\Models\SchemaModel;

class AllSchemasByTenantQuerySql extends GenericQuerySql implements ISchemaQuery
{
    private $_tenantId;

    public function __construct(MySQLLink $link, $tenantId)
    {
        $model = new SchemaModel();
        $this->_tenantId = $tenantId;
        parent::__construct($link, $model);
    }

    public function fetch()
    {
        $model = $this->_model;
        $model->condition('tenant_id', '=', $this->_tenantId);
        $model->read();
        return $model->result()->toArray();
    }
}
