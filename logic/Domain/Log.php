<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class Log extends ValueObject {
    public $log_id;
    public $tenant_id;
    public $action;
    public $details;
    public $log_type;
    public $created_at;
    public $updated_at;
}
