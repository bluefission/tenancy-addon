<?php

namespace AddOns\Tenancy\Business\Services;

use BlueFission\Services\Service;
use AddOns\Tenancy\Domain\Repositories\ISchemaRepository;
use AddOns\Tenancy\Domain\Schema;

class SchemaManager extends Service {
    
    private $_schemaRepo;

    public function __construct(ISchemaRepository $schemaRepo) {
        $this->_schemaRepo = $schemaRepo;
        parent::__construct();
    }

    public function createSchema($tenant_id, $schemaName) {
        $schema = new Schema();
        $schema->tenant_id = $tenant_id;
        $schema->schema_name = $schemaName;

        $this->_schemaRepo->save($schema);
        return $schema;
    }

    public function updateSchema($schema_id, $data) {
        $schema = $this->_schemaRepo->find($schema_id);
        if (!$schema) {
            return null;
        }

        foreach ($data as $key => $value) {
            if (property_exists($schema, $key)) {
                $schema->$key = $value;
            }
        }

        $this->_schemaRepo->save($schema);
        return $schema;
    }

    public function deleteSchema($schema_id) {
        $this->_schemaRepo->remove($schema_id);
        return true;
    }

    public function listSchemasByTenant($tenant_id) {
        return $this->_schemaRepo->findByTenant($tenant_id);
    }
}
