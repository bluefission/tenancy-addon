<?php

use BlueFission\BlueCore\Datasource\Generator;
use AddOns\Tenancy\Domain\Models\TenantLogTypeModel;
use AddOns\Tenancy\Domain\Models\AddOnStatusModel;
use AddOns\Tenancy\Domain\Enums\TenantLogTypeEnum;
use AddOns\Tenancy\Domain\Enums\AddOnStatusEnum;

class SystemDataSeeder extends Generator
{
    public function populate()
    {
        foreach (TenantLogTypeEnum::cases() as $logType) {
            $model = new TenantLogTypeModel();
            $model->name = $logType->value;
            $model->description = $logType->label();
            $model->write();
        }

        foreach (AddOnStatusEnum::cases() as $status) {
            $model = new AddOnStatusModel();
            $model->name = $status->value;
            $model->description = $status->label();
            $model->write();
        }
    }
}