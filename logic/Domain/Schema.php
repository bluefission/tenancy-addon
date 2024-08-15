<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class Schema extends ValueObject {
    public $schema_id;
    public $tenant_id;
    public $schema_name;
    public $version;
    public $created_at;
    public $updated_at;
}
