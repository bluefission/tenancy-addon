<?php

namespace AddOns\Tenancy\Business\Services;

use BlueFission\Services\Service;
use AddOns\Tenancy\Domain\Repositories\IBackupConfigurationRepository;
use AddOns\Tenancy\Domain\BackupConfiguration;

class BackupManager extends Service {
    
    private $_backupRepo;

    public function __construct(IBackupConfigurationRepository $backupRepo) {
        $this->_backupRepo = $backupRepo;
        parent::__construct();
    }

    public function configureBackup($tenant_id, $frequency, $retention_period) {
        $backupConfig = new BackupConfiguration();
        $backupConfig->tenant_id = $tenant_id;
        $backupConfig->backup_frequency = $frequency;
        $backupConfig->retention_period = $retention_period;

        $this->_backupRepo->save($backupConfig);
        return $backupConfig;
    }

    public function getBackupConfiguration($tenant_id) {
        return $this->_backupRepo->findByTenant($tenant_id);
    }

    public function updateBackupConfiguration($backup_config_id, $data) {
        $backupConfig = $this->_backupRepo->find($backup_config_id);
        if (!$backupConfig) {
            return null;
        }

        foreach ($data as $key => $value) {
            if (property_exists($backupConfig, $key)) {
                $backupConfig->$key = $value;
            }
        }

        $this->_backupRepo->save($backupConfig);
        return $backupConfig;
    }
}
