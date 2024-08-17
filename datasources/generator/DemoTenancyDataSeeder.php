<?php

use BlueFission\BlueCore\Datasource\Generator;
use Faker\Factory as Faker;
use AddOns\Tenancy\Domain\Models\TenantModel;
use AddOns\Tenancy\Domain\Models\LogTypeModel;
use AddOns\Tenancy\Domain\Models\AddOnModel;
use AddOns\Tenancy\Domain\Models\AddOnStatusModel;
use AddOns\Tenancy\Domain\Models\SchemaModel;
use AddOns\Tenancy\Domain\Models\TenantAddOnInstallationModel;
use AddOns\Tenancy\Domain\Models\DatabaseModel;
use AddOns\Tenancy\Domain\Repositories\ITenantRepository;
use AddOns\Tenancy\Domain\Repositories\IAddOnRepository;
use AddOns\Tenancy\Domain\Enums\LogTypeEnum;
use AddOns\Tenancy\Domain\Enums\AddOnStatusEnum;

class DemoTenancyDataSeeder extends Generator
{
    public function populate()
    {
        $faker = Faker::create();

        // Instantiate Models
        $tenant = new TenantModel();
        $logType = new LogTypeModel();
        $addon = new AddOnModel();
        $addonStatus = new AddOnStatusModel();
        $schema = new SchemaModel();
        $database = new DatabaseModel();
        $installation = new TenantAddOnInstallationModel();

        // Seed fake tenants
        for ($i = 0; $i < 10; $i++) {
            // Create Tenant
            $tenant->clear();
            $tenant->name = $faker->company();
            $tenant->domain = $faker->domainName();
            $tenant->config = json_encode(['theme' => $faker->randomElement(['light', 'dark'])]);
            $tenant->write();
            echo 'Creating tenant '.$tenant->status()."\n";

            // Assign databases to tenants
            $database->clear();
            $database->name = $faker->domainWord() . '_db';
            $database->host = $faker->ipv4();
            $database->username = $faker->userName();
            $database->password = password_hash($faker->password(), PASSWORD_DEFAULT);
            $database->port = $faker->randomElement(['3306', '5432']);
            $database->write();
            echo 'Creating database '.$database->status()."\n";

            $schema->clear();
            $schema->tenant_id = $tenant->tenant_id;
            $schema->schema_name = $faker->domainWord() . '_schema';
            $schema->version = '1.0';
            $schema->write();
            echo 'Creating schema '.$schema->status()."\n";

            // Seed fake addons
            for ($j = 0; $j < 3; $j++) {
                $addon->clear();
                $addon->name = $faker->word();
                $addon->description = $faker->sentence();
                $addon->version = '1.0';
                $addon->write();
                echo 'Creating addon '.$addon->status()."\n";

                $installation->clear();
                $installation->tenant_id = $tenant->tenant_id;
                $installation->addon_id = $addon->addon_id;
                $installation->status = AddOnStatusEnum::INSTALLED->value;
                $installation->installed_version = '1.0';
                $installation->write();
                echo 'Installing addon for tenant '.$installation->status()."\n";
            }

            // Seed logs for tenants
            foreach (LogTypeEnum::cases() as $logTypeEnum) {
                $logType->clear();
                $logType->name = $logTypeEnum->value;
                $logType->description = $logTypeEnum->label();
                $logType->write();
                echo 'Creating log type '.$logType->status()."\n";
            }
        }
    }
}
