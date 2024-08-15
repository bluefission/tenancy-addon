<?php

namespace AddOns\Tenancy\Business\Services;

use BlueFission\Services\Service;
use AddOns\Tenancy\Domain\Repositories\IAddOnRepository;
use AddOns\Tenancy\Domain\Repositories\ITenantAddOnInstallationRepository;
use AddOns\Tenancy\Domain\AddOn;
use AddOns\Tenancy\Domain\TenantAddOnInstallation;

class AddOnManager extends Service {
    
    private $_addonRepo;
    private $_tenantAddOnRepo;

    public function __construct(IAddOnRepository $addonRepo, ITenantAddOnInstallationRepository $tenantAddOnRepo) {
        $this->_addonRepo = $addonRepo;
        $this->_tenantAddOnRepo = $tenantAddOnRepo;
        parent::__construct();
    }

    public function installAddOnToTenant($tenant_id, $addon_id) {
        $installation = new TenantAddOnInstallation();
        $installation->tenant_id = $tenant_id;
        $installation->addon_id = $addon_id;
        $installation->status = 'installed';

        $this->_tenantAddOnRepo->save($installation);
        return $installation;
    }

    public function uninstallAddOnFromTenant($installation_id) {
        $this->_tenantAddOnRepo->remove($installation_id);
        return true;
    }

    public function listAddOns() {
        return $this->_addonRepo->findAll();
    }

    public function listInstalledAddOnsByTenant($tenant_id) {
        return $this->_tenantAddOnRepo->findByTenant($tenant_id);
    }
}
