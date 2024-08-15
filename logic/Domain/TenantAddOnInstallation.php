<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class TenantAddOnInstallation extends ValueObject {
    public $installation_id;
    public $tenant_id;
    public $addon_id;
    public $status;
    public $installed_version;
    public $created_at;
    public $updated_at;
}
