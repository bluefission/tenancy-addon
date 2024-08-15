<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use AddOns\Tenancy\Domain\Models\TenantModel;
use AddOns\Tenancy\Domain\Tenant;

class TenantRepositorySql extends RepositorySql implements ITenantRepository
{
    public function __construct(MySQLLink $link)
    {
        $model = new TenantModel();
        parent::__construct($link, $model, "tenants");
    }

    public function findByDomain($domain)
    {
        $this->_model->condition('domain', '=', $domain);
        $this->_model->read();
        return $this->_model->response();
    }
}