<?php
use BlueFission\BlueCore\Menu;
use BlueFission\BlueCore\MenuItem;
use BlueFission\BlueCore\Business\Managers\NavMenuManager;

// Create a new instance of NavMenuManager
$navMenuManager = instance('nav');

// Create side nav menu and add items
$sideNav = $navMenuManager->getMenu('sidebar');
$sideNav->addItem(new MenuItem('Tenancy', 'tenancy'));