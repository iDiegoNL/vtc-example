<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class, // Make sure this runs before the UserSeeder
            UserSeeder::class,
            CompanySeeder::class,
            EventRequestSeeder::class,
        ]);
    }
}
