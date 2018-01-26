<?php

use Illuminate\Database\Seeder;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Maintenance::class, 1)->create([
            'pac_id' => 4,
            'company_id' => 3
        ]);

        factory(\App\Models\Maintenance::class, 1)->create([
            'pac_id' => 4,
            'company_id' => 2
        ]);

        factory(\App\Models\Maintenance::class, 1)->create([
            'pac_id' => 5,
            'company_id' => 3
        ]);

        factory(\App\Models\Maintenance::class, 3)->create([]);
    }
}
