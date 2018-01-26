<?php

use Illuminate\Database\Seeder;

class PacsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pacs = factory(\App\Models\Pac::class, 1)->create([]);

        foreach($pacs as $pac) {
            $pac->building_owner_id = 8;
            $pac->owner_id = 8;
            $pac->user_id = 8;
            $pac->save();
        }

        $pacs = factory(\App\Models\Pac::class, 1)->create([]);

        foreach($pacs as $pac) {
            $pac->building_owner_id = 10;
            $pac->owner_id = 11;
            $pac->user_id = 12;
            $pac->save();
        }

        $pacs = factory(\App\Models\Pac::class, 1)->create([]);

        foreach($pacs as $pac) {
            $pac->building_owner_id = 12;
            $pac->owner_id = 12;
            $pac->user_id = 13;
            $pac->save();
        }

        $pacs = factory(\App\Models\Pac::class, 2)->create([]);

        foreach($pacs as $pac) {
            $pac->building_owner_id = rand(8, 13);
            $pac->owner_id = rand(8, 13);
            $pac->user_id = rand(8, 13);
            $pac->save();
        }

    }
}
