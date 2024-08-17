<?php

use BlueFission\BlueCore\Datasource\Generator;
use AddOns\Tenancy\Domain\Models\LogTypeModel;
use AddOns\Tenancy\Domain\Models\AddOnStatusModel;
use AddOns\Tenancy\Domain\Enums\LogTypeEnum;
use AddOns\Tenancy\Domain\Enums\AddOnStatusEnum;

class SystemDataSeeder extends Generator
{
    public function populate()
    {
        foreach (LogTypeEnum::cases() as $logType) {
            $model = new LogTypeModel();
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