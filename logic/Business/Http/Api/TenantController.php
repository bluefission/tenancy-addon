<?php

namespace AddOns\Tenancy\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Tenancy\Domain\Queries\IAllTenantsQuery;
use AddOns\Tenancy\Domain\Repositories\ITenantRepository;
use AddOns\Tenancy\Domain\Tenant;

class TenantController extends BaseController {

    public function index(IAllTenantsQuery $query) {
        $tenants = $query->fetch();
        return response($tenants);
    }

    public function find($tenant_id, ITenantRepository $repository) {
        $tenant = $repository->find($tenant_id);
        return response($tenant);
    }

    public function save(Request $request, ITenantRepository $repository) {
        $tenant = new Tenant();
        foreach ($request->all() as $key => $value) {
            if (property_exists($tenant, $key)) {
                $tenant->$key = $value;
            }
        }

        // Save the new tenant
        $model = $repository->save($tenant);
        return response($model);
    }

    public function update(Request $request, ITenantRepository $repository) {
        return $this->save($request, $repository);
    }

    public function findByDomain($domain, ITenantRepository $repository) {
        $tenant = $repository->findByDomain($domain);
        return response($tenant);
    }
}
