<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class DatabaseModel extends Model {
    protected $_table = 'tenancy_databases';
    protected $_fields = [
        'database_id',
        'name',
        'host',
        'username',
        'password',
        'port',
        'created_at',
        'updated_at',
    ];

    public function tenants()
    {
        return $this->associates(TenantDatabaseAssignmentModel::class, 'database_id');
    }
}
