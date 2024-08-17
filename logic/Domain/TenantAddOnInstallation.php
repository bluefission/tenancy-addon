<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class TenantAddOnInstallation extends ValueObject {
    public $tenant_addon_installation_id;
    public $tenant_id;
    public $addon_id;
    public $addon_status_id;
    public $installed_version;
    public $created_at;
    public $updated_at;
}
