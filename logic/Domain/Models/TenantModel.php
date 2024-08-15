<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TenantModel extends Model {
    protected $_table = 'tenancy_tenants';
    protected $_fields = [
        'tenant_id',
        'name',
        'domain',
        'config',
        'created_at',
        'updated_at',
    ];

    public function databases()
    {
        return $this->associates(TenantDatabaseAssignmentModel::class, 'tenant_id');
    }

    public function schemas()
    {
        return $this->associates(SchemaModel::class, 'tenant_id');
    }

    public function addons()
    {
        return $this->descendents(TenantAddonInstallationModel::class, 'tenant_id');
    }

    public function logs()
    {
        return $this->descendents(LogModel::class, 'tenant_id');
    }

    public function backups()
    {
        return $this->descendents(BackupConfigurationModel::class, 'tenant_id');
    }
}
