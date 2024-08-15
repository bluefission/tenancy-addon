<?php

namespace AddOns\Tenancy\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Tenancy\Domain\Queries\IAllDatabasesQuery;
use AddOns\Tenancy\Domain\Repositories\IDatabaseRepository;
use AddOns\Tenancy\Domain\Database;

class DatabaseController extends BaseController {

    public function index(IAllDatabasesQuery $query) {
        $databases = $query->fetch();
        return response($databases);
    }

    public function find($database_id, IDatabaseRepository $repository) {
        $database = $repository->find($database_id);
        return response($database);
    }

    public function save(Request $request, IDatabaseRepository $repository) {
        $database = new Database();
        foreach ($request->all() as $key => $value) {
            if (property_exists($database, $key)) {
                $database->$key = $value;
            }
        }

        // Save the new database
        $model = $repository->save($database);
        return response($model);
    }

    public function update(Request $request, IDatabaseRepository $repository) {
        return $this->save($request, $repository);
    }

    public function findByName($name, IDatabaseRepository $repository) {
        $database = $repository->findByName($name);
        return response($database);
    }
}
