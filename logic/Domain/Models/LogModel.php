<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class LogModel extends Model {
    protected $_table = 'tenancy_logs';
    protected $_fields = [
        'log_id',
        'tenant_id',
        'action',
        'details',
        'log_type',
        'created_at',
        'updated_at',
    ];

    public function tenant()
    {
        return $this->ancestor(TenantModel::class, 'tenant_id');
    }
}
