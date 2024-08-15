<?php

namespace AddOns\Tenancy\Business\Http\Api;

use BlueFission\Services\Request;
use BlueFission\BlueCore\BaseController;
use AddOns\Tenancy\Domain\Queries\IAllAddOnsQuery;
use AddOns\Tenancy\Domain\Repositories\IAddOnRepository;
use AddOns\Tenancy\Domain\AddOn;

class AddOnController extends BaseController {

    public function index(IAllAddOnsQuery $query) {
        $addons = $query->fetch();
        return response($addons);
    }

    public function find($addon_id, IAddOnRepository $repository) {
        $addon = $repository->find($addon_id);
        return response($addon);
    }

    public function save(Request $request, IAddOnRepository $repository) {
        $addon = new AddOn();
        foreach ($request->all() as $key => $value) {
            if (property_exists($addon, $key)) {
                $addon->$key = $value;
            }
        }

        // Save the new addon
        $model = $repository->save($addon);
        return response($model);
    }

    public function update(Request $request, IAddOnRepository $repository) {
        return $this->save($request, $repository);
    }

    public function findByName($name, IAddOnRepository $repository) {
        $addon = $repository->findByName($name);
        return response($addon);
    }
}
