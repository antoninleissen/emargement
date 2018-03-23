<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 23/03/18
 * Time: 13:55
 */

use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->truncate();

        $data = $this->getData('student');

        $app = app()::getInstance();
        $roomManager = $app->make(\App\Models\Student::class);
        foreach ($data as $datum){
            $roomManager->create([
                'name'=>$datum->name
            ]);
        }


    }
}
