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
        //$this->call(AccountsTableSeeder::class);
        $this->call(TestsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
//        $this->call(SpeakersTableSeeder::class);
//        $this->call(ClassroomsTableSeeder::class);

    }
}
