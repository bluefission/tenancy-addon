<?php

use BlueFission\Services\Mapping;

Mapping::crud('api/admin', '', 'AddOns\Hestia\Business\Http\Api\Admin\TenancyController', 'lodging_id')->gateway('admin:auth');