<?php

use BlueFission\BlueCore\Datasource\Delta;
use BlueFission\Data\Storage\Structure\MySQLStructure as Structure;
use BlueFission\Data\Storage\Structure\MySQLScaffold as Scaffold;

class CreateMultiTenantAddonTables extends Delta
{
    public function change()
    {
        // Tenants table: stores information about each tenant, including configuration details
        Scaffold::create('tenancy_tenants', function (Structure $entity) {
            $entity->incrementer('tenant_id');
            $entity->text('name');
            $entity->text('domain')->unique();
            $entity->json('config')->null();
            $entity->timestamps();
            $entity->comment("Stores basic information and configurations for each tenant.");
        });

        // Databases table: tracks which database each tenant is assigned to, allowing for scalability and compliance
        Scaffold::create('tenancy_databases', function (Structure $entity) {
            $entity->incrementer('database_id');
            $entity->text('name')->unique();
            $entity->text('host');
            $entity->text('username');
            $entity->text('password');
            $entity->text('port')->default('3306');
            $entity->timestamps();
            $entity->comment("Tracks the databases available for tenant allocation.");
        });

        // Tenant Database Assignments: links tenants to their assigned databases, supporting multi-database deployment
        Scaffold::create('tenancy_tenant_database_assignments', function (Structure $entity) {
            $entity->incrementer('assignment_id');
            $entity->numeric('tenant_id')->foreign('tenancy_tenants', 'tenant_id');
            $entity->numeric('database_id')->foreign('tenancy_databases', 'database_id');
            $entity->timestamps();
            $entity->comment("Links tenants to the databases they are assigned to.");
        });

        // Schemas table: tracks tenant-specific schemas within a database
        Scaffold::create('tenancy_schemas', function (Structure $entity) {
            $entity->incrementer('schema_id');
            $entity->numeric('tenant_id')->foreign('tenancy_tenants', 'tenant_id');
            $entity->text('schema_name')->unique();
            $entity->text('version')->null();
            $entity->timestamps();
            $entity->comment("Stores information about each tenant's schema, including versioning.");
        });

        // Addons table: tracks the available addons that can be installed across tenants
        Scaffold::create('tenancy_addons', function (Structure $entity) {
            $entity->incrementer('addon_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->text('version');
            $entity->timestamps();
            $entity->comment("Tracks available addons that can be installed for tenants.");
        });

        // AddOn Statuses: tracks the status of each addon installation for a tenant
        Scaffold::create('tenancy_addon_statuses', function (Structure $entity) {
            $entity->incrementer('addon_status_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
            $entity->comment("Tracks the status of each addon installation for a tenant.");
        });

        // Tenant Addon Installations: links addons to tenant schemas, tracking installation status and versions
        Scaffold::create('tenancy_tenant_addon_installations', function (Structure $entity) {
            $entity->incrementer('installation_id');
            $entity->numeric('tenant_id')->foreign('tenancy_tenants', 'tenant_id');
            $entity->numeric('addon_id')->foreign('tenancy_addons', 'addon_id');
            $entity->numeric('addon_status_id')->foreign('tenancy_addon_statuses', 'addon_status_id');
            $entity->text('installed_version');
            $entity->timestamps();
            $entity->comment("Links addons to tenant schemas, tracking their installation and status.");
        });

        // Migrations table: tracks delta scripts that have been run for each tenant schema
        Scaffold::create('tenancy_deltas', function (Structure $entity) {
            $entity->incrementer('delta_id');
            $entity->numeric('schema_id')->foreign('tenancy_schemas', 'schema_id');
            $entity->text('delta_name');
            $entity->text('batch');
            $entity->timestamps();
            $entity->comment("Tracks the deltas that have been applied to each tenant's schema.");
        });

        // Backup configurations: stores tenant-specific backup configurations, including schedules
        Scaffold::create('tenancy_backup_configurations', function (Structure $entity) {
            $entity->incrementer('backup_config_id');
            $entity->numeric('tenant_id')->foreign('tenancy_tenants', 'tenant_id');
            $entity->text('backup_frequency');
            $entity->text('retention_period');
            $entity->timestamps();
            $entity->comment("Stores backup configurations for each tenant, including schedule and retention.");
        });

        // Log Types: tracks the types of logs that can be generated
        Scaffold::create('tenancy_log_types', function (Structure $entity) {
            $entity->incrementer('log_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
            $entity->comment("Tracks the types of logs that can be generated.");
        });

        // Logs table: tracks tenant-specific actions and system logs
        Scaffold::create('tenancy_logs', function (Structure $entity) {
            $entity->incrementer('log_id');
            $entity->numeric('tenant_id')->foreign('tenancy_tenants', 'tenant_id');
            $entity->text('action');
            $entity->text('details')->null();
            $entity->numeric('log_type_id')->foreign('tenancy_log_types', 'log_type_id');
            $entity->timestamps();
            $entity->comment("Logs actions and events related to tenant management and addon operations.");
        });
    }

    public function revert()
    {
        Scaffold::delete('tenancy_logs');
        Scaffold::delete('tenancy_backup_configurations');
        Scaffold::delete('tenancy_deltas');
        Scaffold::delete('tenancy_tenant_addon_installations');
        Scaffold::delete('tenancy_addons');
        Scaffold::delete('tenancy_schemas');
        Scaffold::delete('tenancy_tenant_database_assignments');
        Scaffold::delete('tenancy_databases');
        Scaffold::delete('tenancy_tenants');
    }
}
