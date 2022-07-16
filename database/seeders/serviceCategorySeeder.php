<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryService;

class serviceCategorySeeder extends Seeder
{

    public function run()
    {
        $serviceCategories = [
            ['name' => 'Hair Cut', 'image' => 'images/service-1.jpg'],
            ['name' => 'Color & Wash', 'image' => 'images/service-2.jpg'],
            ['name' => 'Beard Style', 'image' => 'images/service-3.jpg'],
        ];

        CategoryService::insert($serviceCategories);
    }
}
