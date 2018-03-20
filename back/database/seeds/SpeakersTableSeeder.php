<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 09:56
 */


use Illuminate\Support\Facades\DB;

class SpeakersTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('speakers')->truncate();

        $data = $this->getData('speaker');

        $app = app()::getInstance();
        $roomManager = $app->make(\App\Models\Room::class);
        foreach ($data as $datum){
            $roomManager->create([
                'name'=>$datum->name
            ]);
        }


    }
}
