<?php

namespace AddOns\Tenancy\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Tenancy\Domain\Queries\IAllLogsByTenantQuery;
use AddOns\Tenancy\Domain\Repositories\ILogRepository;
use AddOns\Tenancy\Domain\Log;

class LogController extends BaseController {

    public function index($tenant_id, IAllLogsByTenantQuery $query) {
        $logs = $query->fetch();
        return response($logs);
    }

    public function find($log_id, ILogRepository $repository) {
        $log = $repository->find($log_id);
        return response($log);
    }

    public function save(Request $request, ILogRepository $repository) {
        $log = new Log();
        foreach ($request->all() as $key => $value) {
            if (property_exists($log, $key)) {
                $log->$key = $value;
            }
        }

        // Save the new log entry
        $model = $repository->save($log);
        return response($model);
    }

    public function update(Request $request, ILogRepository $repository) {
        return $this->save($request, $repository);
    }

    public function findByTenantAndType($tenant_id, $log_type, ILogRepository $repository) {
        $logs = $repository->findByTenantAndType($tenant_id, $log_type);
        return response($logs);
    }
}
