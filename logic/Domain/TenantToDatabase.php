<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class TenantToDatabase extends ValueObject {
    public $assignment_id;
    public $tenant_id;
    public $database_id;
    public $created_at;
    public $updated_at;
}
