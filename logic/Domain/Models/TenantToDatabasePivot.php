<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TenantToDatabasePivot extends Model {
    protected $_table = 'tenancy_tenant_to_database';
    protected $_fields = [
        'assignment_id',
        'tenant_id',
        'database_id',
        'created_at',
        'updated_at',
    ];

    public function tenant()
    {
        return $this->ancestor(TenantModel::class, 'tenant_id');
    }

    public function database()
    {
        return $this->ancestor(DatabaseModel::class, 'database_id');
    }
}
