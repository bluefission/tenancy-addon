<?php

namespace AddOns\Tenancy\Domain;

use BlueFission\BlueCore\ValueObject;

class Database extends ValueObject {
    public $database_id;
    public $name;
    public $host;
    public $username;
    public $password;
    public $port;
    public $created_at;
    public $updated_at;
}
