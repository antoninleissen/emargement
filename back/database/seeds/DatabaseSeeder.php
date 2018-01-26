<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompaniesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(TechniciansTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(PacsTableSeeder::class);
        $this->call(InterventionsTableSeeder::class);
        $this->call(MaintenancesTableSeeder::class);
    }
}
