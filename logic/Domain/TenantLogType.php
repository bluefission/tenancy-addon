<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class TenantLogType extends ValueObject {
    public $log_type_id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at;
}
