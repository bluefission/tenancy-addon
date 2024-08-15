<?php

namespace AddOns\Tenancy\Business\Services;

use BlueFission\Services\Service;
use AddOns\Tenancy\Domain\Repositories\ITenantRepository;
use AddOns\Tenancy\Domain\Tenant;

class TenantManager extends Service {
    
    private $_tenantRepo;

    public function __construct(ITenantRepository $tenantRepo) {
        $this->_tenantRepo = $tenantRepo;
        parent::__construct();
    }

    public function createTenant($data) {
        $tenant = new Tenant();
        foreach ($data as $key => $value) {
            if (property_exists($tenant, $key)) {
                $tenant->$key = $value;
            }
        }

        $this->_tenantRepo->save($tenant);
        return $tenant;
    }

    public function updateTenant($tenant_id, $data) {
        $tenant = $this->_tenantRepo->find($tenant_id);
        if (!$tenant) {
            return null;
        }

        foreach ($data as $key => $value) {
            if (property_exists($tenant, $key)) {
                $tenant->$key = $value;
            }
        }

        $this->_tenantRepo->save($tenant);
        return $tenant;
    }

    public function deleteTenant($tenant_id) {
        $this->_tenantRepo->remove($tenant_id);
        return true;
    }

    public function listTenants() {
        return $this->_tenantRepo->findAll();
    }
}
