<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ---------------- Subjects ----------------
        DB::table('subjects')->insert([
            ['name' => 'Myanmar'],
            ['name' => 'English'],
            ['name' => 'Math'],
        ]);

        // ---------------- Teachers ----------------
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

        // ---------------- Grades ----------------
        DB::table('grades')->insert([
            ['name' => 'Grade-1'],
            ['name' => 'Grade-2'],
        ]);

        // ---------------- Roles & Permissions ----------------
        $this->call(RolePermissionSeeder::class);

        // Ensure roles exist
        $adminRole   = Role::where('name', 'Admin')->first();
        $teacherRole = Role::where('name', 'Teacher')->first();

        // ---------------- Users ----------------

        // Admin 1
        $user1 = User::firstOrCreate(
            ['email' => 'thetkhine@gmail.com'],
            [
                'name'     => 'U Thet Khine',
                'password' => Hash::make('thetkhine.magway'),
            ]
        );
        $user1->assignRole($adminRole);

        // Admin 2
        $user2 = User::firstOrCreate(
            ['email' => 'aungthurahein@gmail.com'],
            [
                'name'     => 'U Aung Thura Hein',
                'password' => Hash::make('aungthurahein.magway'),
            ]
        );
        $user2->assignRole($adminRole);

        // Admin Teacher
        $user3 = User::firstOrCreate(
            ['email' => 'phyowintkyaw@gmail.com'],
            [
                'name'     => 'U Phyo Wint Kyaw',
                'password' => Hash::make('phyowintkyaw.magway'),
            ]
        );
        $user3->assignRole($teacherRole);
    }
}
