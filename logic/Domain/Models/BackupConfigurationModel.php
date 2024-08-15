<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class BackupConfigurationModel extends Model {
    protected $_table = 'tenancy_backup_configurations';
    protected $_fields = [
        'backup_config_id',
        'tenant_id',
        'backup_frequency',
        'retention_period',
        'created_at',
        'updated_at',
    ];

    public function tenant()
    {
        return $this->ancestor(TenantModel::class, 'tenant_id');
    }
}
