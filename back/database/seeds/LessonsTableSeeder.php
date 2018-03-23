<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 19/03/18
 * Time: 15:15
 */


use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends DataSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->truncate();

        $data = $this->getData('lessons');

        $app = app()::getInstance();
        $lessonManager = $app->make(\App\Models\Lesson::class);
        foreach ($data as $datum){
            $lessonManager->create([
                'name'=>$datum->name
            ]);
        }

    }
}
