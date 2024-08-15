<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class AddOnStatus extends ValueObject {
    public $status_id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at;
}
