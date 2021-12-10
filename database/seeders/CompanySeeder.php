<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyApplication;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory(10)
            ->has(CompanyApplication::factory()->count(50), 'applications') // Give the company 50 applications
            ->create();
    }
}
