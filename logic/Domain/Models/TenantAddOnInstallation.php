<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TenantAddOnInstallationModel extends Model {
    protected $_table = 'tenancy_tenant_addon_installations';
    protected $_fields = [
        'installation_id',
        'tenant_id',
        'addon_id',
        'status',
        'installed_version',
        'created_at',
        'updated_at',
    ];

    public function tenant()
    {
        return $this->ancestor(TenantModel::class, 'tenant_id');
    }

    public function addon()
    {
        return $this->ancestor(AddonModel::class, 'addon_id');
    }
}
