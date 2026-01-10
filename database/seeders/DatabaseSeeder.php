<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ------- Subjects -------
        DB::table('subjects')->insert([
            ['name' => 'Myanmar'],
            ['name' => 'English'],
            ['name' => 'Math'],
        ]);

        // ------- Teachers -------
        DB::table('teachers')->insert([
            [
                'name' => 'MTN',
                'education' => 'B.C.Tech',
                'photo' => '1.jpg',
                'phone' => '08334',
                'email' => 'mtn@gmail.com',
            ],
            [
                'name' => 'SSM',
                'education' => 'B.C.Sc',
                'photo' => '2.jpg',
                'phone' => '097u8778',
                'email' => 'ssm@gmail.com',
            ]
        ]);

        DB::table('grades')->insert([
    ['name' => 'Grade-1'],
    ['name' => 'Grade-2'],
]);

    }
}
