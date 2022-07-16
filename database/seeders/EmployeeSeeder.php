<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employes = [
            [
                'name' => 'Adam Philips',
                'skill' => 'Master Barber',
                'description' => 'Experienced in barber for 7 years',
                'image' => 'images/team-1.jpg'
            ],
            [
                'name' => 'Dylan Adams',
                'skill' => 'Hair Expert',
                'description' => 'Have good knowledge in hair world',
                'image' => 'images/team-2.jpg'

            ],
            [
                'name' => 'Gloria Edwards',
                'skill' => 'Beard Expert',
                'description' => 'Experienced in bread expert for 5 years',
                'image' => 'images/team-3.jpg'

            ],
            [
                'name' => 'Josh Dunn',
                'skill' => 'Color Expert',
                'description' => 'Experienced in coloring for 9 years',
                'image' => 'images/team-4.jpg'

            ],

        ];

        Employee::insert($employes);
    }
}
