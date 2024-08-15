<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class AddOnStatusModel extends Model {
    protected $_table = 'tenancy_addon_statuses';
    protected $_fields = [
        'status_id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
