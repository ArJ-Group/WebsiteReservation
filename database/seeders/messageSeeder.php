<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Message;

class messageSeeder extends Seeder
{

    public function run()
    {
      
        $msg = [
           [
            'name' => 'Widiareta',
            'email' => 'widiareta@gmail.com',
            'title' => 'It Was Very Nice Service',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 1
        ],
        [
            'name' => 'Hanum Aisyah Algadrie',
            'email' => 'hanumaisyah@gmail.com',
            'title' => 'I Love the style of my hair',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 0
        ],
        [
            'name' => 'Rimadhani Aula Marufah',
            'email' => 'rimadhani@gmail.com',
            'title' => 'My hair get pretty',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 1
        ],
        [
            'name' => 'Putri Lydia Puspita Sari',
            'email' => 'putri@gmail.com',
            'title' => 'I like the service',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 0
        ],
        [
            'name' => 'Omar Abdul',
            'email' => 'omar@gmail.com',
            'title' => 'I like the service',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 1
        ],
        [
            'name' => 'Ariono Septian Jaya',
            'email' => 'putri@gmail.com',
            'title' => 'You want beautiful hair? come here',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 1
        ],

        ];

        Message::insert($msg);
           
          
    }
}
