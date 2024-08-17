<?php
namespace AddOns\Tenancy;

use AddOns\Tenancy\Registration\TenancyRegistration;
use BlueFission\Utils\Loader;
use BlueFission\Services\Service;
use BlueFission\BlueCore\Theme;

class TenancyAddOn extends Service {
	private $_loader;

	public function __construct() {
		$this->_loader = Loader::instance();
		listen('OnAppLoaded', [$this, 'bootstrap']);
		parent::__construct();
	}

	public function bootstrap()
	{
		$registration = new TenancyRegistration;
		$registration->init();
		
		$this->autoDiscoverMapping();
	}

	private function autoDiscoverMapping() {
		$this->_loader->load("addons.tenancy-addon.mapping.*");
	}
}