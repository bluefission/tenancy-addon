<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class SchemaModel extends Model {
    protected $_table = 'tenancy_schemas';
    protected $_fields = [
        'schema_id',
        'tenant_id',
        'schema_name',
        'version',
        'created_at',
        'updated_at',
    ];

    public function tenant()
    {
        return $this->ancestor(TenantModel::class, 'tenant_id');
    }

    public function migrations()
    {
        return $this->descendents(MigrationModel::class, 'schema_id');
    }
}
