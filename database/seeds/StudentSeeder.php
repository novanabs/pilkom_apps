<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = [[
            'nim' => 'A1C615017',
            'name' => "Muhammad Febry Mahfuz",
            'email' => 'A1C615017@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => 'A1C615046',
            'name' => "Nara Agustin",
            'email' => 'A1C615046@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1610131210019',
            'name' => "Widodo Setio Sejati",
            'email' => '1610131210019@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1610131310003',
            'name' => "Arief Permana",
            'email' => '1610131310003@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => 'A1C615011',
            'name' => "Erlyani Utami",
            'email' => 'A1C615011@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1610131220018',
            'name' => "Siti Aisyah",
            'email' => '1610131220018@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1610131320015',
            'name' => "Ria Rizky Rahmawati",
            'email' => '1610131320015@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1610131210001',
            'name' => "ADI PEBRIAN RAHMAN",
            'email' => '1610131210001@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1710131210002',
            'name' => "Ahmad Ramadhani",
            'email' => '1710131210002@ulm.ac.id',
            'password' => Hash::make('password'),
        ],[
            'nim' => '1710131320042',
            'name' => "Syifa Saputra Berlian",
            'email' => '1710131320042@ulm.ac.id',
            'password' => Hash::make('password'),
        ],
        [
            'nim' => 'A1C615039',
            'name' => "Firman Abdul Jabar",
            'email' => 'A1C615039@ulm.ac.id',
            'password' => Hash::make('password'),
        ]
        ];
        
        DB::table('students')->insert($student);
    }
}