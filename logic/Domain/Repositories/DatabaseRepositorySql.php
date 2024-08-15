<?php

namespace AddOns\Tenancy\Domain\Repositories;

use BlueFission\Connections\Database\MySQLLink;
use BlueFission\BlueCore\Repository\RepositorySql;
use AddOns\Tenancy\Domain\Models\DatabaseModel;

class DatabaseRepositorySql extends RepositorySql implements IDatabaseRepository
{
    public function __construct(MySQLLink $link)
    {
        $model = new DatabaseModel();
        parent::__construct($link, $model, "databases");
    }

    public function findByName($name)
    {
        $this->_model->condition('name', '=', $name);
        $this->_model->read();
        return $this->_model->response();
    }
}