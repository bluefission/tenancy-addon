<?php
namespace AddOns\Tenancy\Registration;

use AddOns\Tenancy\Business\Managers\LodgingManager;
use BlueFission\BlueCore\IExtension;
use BlueFission\BlueCore\Theme;
use BlueFission\Utils\Loader;

class TenancyRegistration implements IExtension 
{
	private $_app;
	private $_name = "Tenancy";
	private $_loader;

	public function __construct()
	{
		$this->_app = instance();
		$this->_loader = Loader::instance();
		$this->_loader->addPath(dirname(dirname(__DIR__)));
	}

	public function init()
	{
		$this->_app->addTheme(new Theme('tenancy-addon/default', 'tenancy'));
		$this->_loader->load("mapping.*");

		$config = require OPUS_ROOT.'addons'.DIRECTORY_SEPARATOR.'tenancy-addon'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'tenancy.php';
		$this->_app->configuration('tenancy', $config);

		$this->bindings();
		$this->arguments();
		$this->registrations();
	}

	private function registrations()
	{
		$this->_app->delegate('tenancy', LodgingManager::class);
	}
	
	private function arguments()
	{
		// $data = $this->_app->configuration('tenancy');
	}

	private function bindings()
	{
		$this->_app->bind('AddOns\Tenancy\Domain\Queries\IAllLodgingsQuery', 'AddOns\Tenancy\Domain\Queries\AllLodgingsQuerySql');
		$this->_app->bind('AddOns\Tenancy\Domain\Repositories\ILodgingRepository', 'AddOns\Tenancy\Domain\Repositories\LodgingRepositorySql');
	}

	public function name()
	{
		return $this->_name;
	}

	public function install()
	{
		$this->updateDB();	
	}

	public function uninstall()
	{
		$this->revertDB();
	}

	public function updateDB()
	{

	}

	public function revertDB()
	{
		
	}
}