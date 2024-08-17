<?php
namespace AddOns\Tenancy\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;

class AdminController extends Service {

    public function main( ) 
    {
        return template('tenancy-addon/default', 'admin/panels/index.html');
    }
}