<?php

use Illuminate\Database\Seeder;

class InterventionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Intervention::class, 5)->create([]);
    }
}
