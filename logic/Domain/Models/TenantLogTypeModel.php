<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TenantLogTypeModel extends Model {
    protected $_table = 'tenancy_log_types';
    protected $_fields = [
        'log_type_id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}