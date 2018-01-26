<?php

use Illuminate\Support\Facades\DB;

class TestsTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->truncate();

        $data = $this->getData('tests');

        $app = app()::getInstance();
        $countryManager = $app->make(\App\Models\Test::class);
        foreach ($data as $datum){
            $countryManager->create([
                'test1'=>$datum->test1,
                'test2'=>$datum->test2
            ]);
        }


    }
}