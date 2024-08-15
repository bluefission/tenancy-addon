<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class Delta extends ValueObject {
    public $delta_id;
    public $schema_id;
    public $delta_name;
    public $batch;
    public $created_at;
    public $updated_at;
}
