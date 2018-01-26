<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Company::class)->create([
            'name' => 'Amzair'
        ]);

        factory(\App\Models\Company::class)->create([
            'name' => 'STA'
        ]);

        factory(\App\Models\Company::class)->create([
            'name' => 'Installateur'
        ]);
    }
}
