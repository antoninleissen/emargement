<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    protected $time;

    public function run(){
        return false;
    }

    protected function getData($name)
    {
        $name      = str_replace(' ', '_', $name);
        $sDataPath = $this->getDataPath($name.'.json');
        $oData     = $sDataPath !== false ? json_decode(file_get_contents($sDataPath)) : null;
        if (!is_null($oData)) {
            $this->command->line("\e[32mloaded:\e[39m $name.json -> $sDataPath\n");

            return $oData;
        } else {
            $this->command->line("\e[31mfile not found:\e[39m $name.json\n");

            return false;
        }
    }

    private function getDataPath($sRelativeFilePath)
    {
        $sSeedsPath    = base_path('database/seeds/data/');
        //$sEnvSeedsPath = $sSeedsPath.env('DB_SEEDER', false);

        $sFilePath = false;
        echo $sSeedsPath.$sRelativeFilePath;
        if (is_file($sSeedsPath.$sRelativeFilePath)) {
            $sFilePath = $sSeedsPath.$sRelativeFilePath;
        }

        return $sFilePath;
    }

    protected function getTime(){
        $this->time = date('Y-m-d H:i:s', time());

        return $this->time;
    }
}