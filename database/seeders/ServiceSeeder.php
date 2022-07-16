<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{

  public function run()
  {
    $services = [
      [
        'category_service_id' => 1,
        'name' => 'Hair Cut',
        'price' => 30000,
        'image' => 'images/price-1.jpg'
      ],

      [
        'category_service_id' => 1,
        'name' => 'Hair Wash',
        'price' => 10000,
        'image' => 'images/price-2.jpg'
      ],
      [
        'category_service_id' => 1,
        'name' => 'Hair Color',
        'price' => 50000,
        'image' => 'images/price-3.jpg'

      ],
      [
        'category_service_id ' => 1,
        'name' => 'Hair Shave',
        'price' => 20000,
        'image' => 'images/price-4.jpg'
      ],
      [
        'category_service_id' => 2,
        'name' => 'Hair Straight',
        'price' => 40000,
        'image' => 'images/price-5.jpg'
      ],
      [
        'category_service_id' => 2,
        'name' => 'Facial',
        'price' => 25000,
        'image' => 'images/price-6.jpg'
      ],
      [
        'category_service_id' => 2,
        'name' => 'Shampoo',
        'price' => 5000,
        'image' => 'images/price-7.jpg'
      ],
      [
        'category_service_id' => 2,
        'name' => 'Beard Trim',
        'price' => 15000,
        'image' => 'images/price-8.jpg'
      ],

      [
        'category_service_id' => 3,
        'name' => 'Beard Shave',
        'price' => 10000,
        'image' => 'images/price-9.jpg'
      ],

      [
        'category_service_id' => 3,
        'name' => 'Wedding Cut',
        'price' => 70000,
        'image' => 'images/price-10.jpg'
      ],
      [
        'category_service_id' => 3,
        'name' => 'Clean Up',
        'price' => 35000,
        'image' => 'images/price-11.jpg'
      ],

      [
        'category_service_id' => 3,
        'name' => 'Massage',
        'price' => 10000,
        'image' => 'images/price-12.jpg'
      ],
    ];

    Service::insert($services);
  }
}
