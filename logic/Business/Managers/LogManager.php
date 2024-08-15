<?php

namespace AddOns\Tenancy\Business\Services;

use BlueFission\Services\Service;
use AddOns\Tenancy\Domain\Repositories\ILogRepository;
use AddOns\Tenancy\Domain\Log;

class LogManager extends Service {
    
    private $_logRepo;

    public function __construct(ILogRepository $logRepo) {
        $this->_logRepo = $logRepo;
        parent::__construct();
    }

    public function createLog($tenant_id, $action, $details = '', $log_type = 'info') {
        $log = new Log();
        $log->tenant_id = $tenant_id;
        $log->action = $action;
        $log->details = $details;
        $log->log_type = $log_type;

        $this->_logRepo->save($log);
        return $log;
    }

    public function listLogsByTenant($tenant_id) {
        return $this->_logRepo->findByTenant($tenant_id);
    }

    public function listLogsByTenantAndType($tenant_id, $log_type) {
        return $this->_logRepo->findByTenantAndType($tenant_id, $log_type);
    }
}
