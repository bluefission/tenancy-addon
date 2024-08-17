<?php
use BlueFission\Services\Mapping;

// Admin
Mapping::add('admin/modules/tenancy', ['AddOns\Tenancy\Business\Http\AdminController', 'main'], 'tenancy.dashboard', 'get')->gateway('admin:auth');
