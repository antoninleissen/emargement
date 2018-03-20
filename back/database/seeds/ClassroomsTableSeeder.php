<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 10:28
 */

use Illuminate\Support\Facades\DB;

class ClassroomsTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->truncate();

        $data = $this->getData('classrooms');

        $app = app()::getInstance();
        $roomManager = $app->make(\App\Models\Room::class);
        foreach ($data as $datum){
            $roomManager->create([
                'name'=>$datum->name,
                'school'=>$datum->school,
            ]);
        }


    }
}
