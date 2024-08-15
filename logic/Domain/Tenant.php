<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class Tenant extends ValueObject {
    public $tenant_id;
    public $name;
    public $domain;
    public $config;
    public $created_at;
    public $updated_at;
}
