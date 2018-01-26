<?php

use Illuminate\Database\Seeder;

class TechniciansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Technician::class, 1)->create([
            'company_id' => 1
        ]);

        factory(\App\Models\Technician::class, 4)->create([]);
    }
}
