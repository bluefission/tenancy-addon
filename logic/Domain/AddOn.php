<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class AddOn extends ValueObject {
    public $addon_id;
    public $name;
    public $description;
    public $version;
    public $created_at;
    public $updated_at;
}
