<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use AddOns\Tenancy\Domain\Models\AddOnModel;

class AddOnRepositorySql extends RepositorySql implements IAddOnRepository
{
    public function __construct(MySQLLink $link)
    {
        $model = new AddOnModel();
        parent::__construct($link, $model, "addons");
    }

    public function findByName($name)
    {
        $this->_model->condition('name', '=', $name);
        $this->_model->read();
        return $this->_model->response();
    }
}