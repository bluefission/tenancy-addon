<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class BackupConfiguration extends ValueObject {
    public $backup_config_id;
    public $tenant_id;
    public $backup_frequency;
    public $retention_period;
    public $created_at;
    public $updated_at;
}
