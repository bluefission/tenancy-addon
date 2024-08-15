<?php

use BlueFission\BlueCore\Datasource\Generator;

class RootSeeder extends Generator
{
    public function populate()
    {

    }

    public function seeders()
    {
        return [
            'SystemDataSeeder',
            'DemoTenancyDataSeeder',
        ];
    }
}