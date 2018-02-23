<?php

use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->truncate();

        $data = $this->getData('rooms');

        $app = app()::getInstance();
        $roomManager = $app->make(\App\Models\Room::class);
        foreach ($data as $datum){
            $roomManager->create([
                'name'=>$datum->name
            ]);
        }


    }
}