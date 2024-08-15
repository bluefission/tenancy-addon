<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use AddOns\Tenancy\Domain\Models\SchemaModel;

class SchemaRepositorySql extends RepositorySql implements ISchemaRepository
{
    public function __construct(MySQLLink $link)
    {
        $model = new SchemaModel();
        parent::__construct($link, $model, "schemas");
    }

    public function findByTenantAndName($tenantId, $schemaName)
    {
        $this->_model->condition('tenant_id', '=', $tenantId);
        $this->_model->condition('schema_name', '=', $schemaName);
        $this->_model->read();
        return $this->_model->response();
    }
}