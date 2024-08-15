<?php

namespace AddOns\Tenancy\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class DeltaModel extends Model {
    protected $_table = 'tenancy_deltas';
    protected $_fields = [
        'delta_id',
        'schema_id',
        'delta_name',
        'batch',
        'created_at',
        'updated_at',
    ];

    public function schema()
    {
        return $this->ancestor(SchemaModel::class, 'schema_id');
    }
}
