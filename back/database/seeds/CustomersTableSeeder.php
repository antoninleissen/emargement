<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Customer::class, 1)->create([
            'company_name' => 'Amzair'
        ]);

        factory(\App\Models\Customer::class, 14)->create([]);
    }
}
