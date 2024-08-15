<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use AddOns\Tenancy\Domain\Models\LogModel;

class LogRepositorySql extends RepositorySql implements ILogRepository
{
    public function __construct(MySQLLink $link)
    {
        $model = new LogModel();
        parent::__construct($link, $model, "logs");
    }

    public function findByTenantAndType($tenantId, $logType)
    {
        $this->_model->condition('tenant_id', '=', $tenantId);
        $this->_model->condition('log_type', '=', $logType);
        $this->_model->read();
        return $this->_model->response();
    }
}