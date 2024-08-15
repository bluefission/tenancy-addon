<?php

namespace AddOns\Tenancy\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Tenancy\Domain\Queries\IAllSchemasByTenantQuery;
use AddOns\Tenancy\Domain\Repositories\ISchemaRepository;
use AddOns\Tenancy\Domain\Schema;

class SchemaController extends BaseController {

    public function index($tenant_id, IAllSchemasByTenantQuery $query) {
        $schemas = $query->fetch();
        return response($schemas);
    }

    public function find($schema_id, ISchemaRepository $repository) {
        $schema = $repository->find($schema_id);
        return response($schema);
    }

    public function save(Request $request, ISchemaRepository $repository) {
        $schema = new Schema();
        foreach ($request->all() as $key => $value) {
            if (property_exists($schema, $key)) {
                $schema->$key = $value;
            }
        }

        // Save the new schema
        $model = $repository->save($schema);
        return response($model);
    }

    public function update(Request $request, ISchemaRepository $repository) {
        return $this->save($request, $repository);
    }

    public function findByTenantAndName($tenant_id, $schema_name, ISchemaRepository $repository) {
        $schema = $repository->findByTenantAndName($tenant_id, $schema_name);
        return response($schema);
    }
}
