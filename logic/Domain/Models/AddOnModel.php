<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class AddOnModel extends Model {
    protected $_table = 'tenancy_addons';
    protected $_fields = [
        'addon_id',
        'name',
        'description',
        'version',
        'created_at',
        'updated_at',
    ];

    public function tenantInstallations()
    {
        return $this->descendents(TenantAddonInstallationModel::class, 'addon_id');
    }
}
