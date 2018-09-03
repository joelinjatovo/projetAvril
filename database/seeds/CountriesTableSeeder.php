<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = $this->getPaysFromCsv();
        foreach($items as $item){
            DB::table('countries')->insert([
                'code_2' => $item[0],
                'code_3' => $item[1],
                'title' => utf8_encode($item[2]),
                'content' => utf8_encode($item[3]),
                'prefixPhone' => $item[4],
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
    
    /*
    * Load country code from csv file
    *
    */
    private function getPaysFromCsv(){
        $ligne = 1;
        $fic = fopen(storage_path()."/csv/pays.csv", "r");
        $listePays = [];
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            for($i=0; $i<$champs; $i++)
            {
                $pays = explode(";", $tab[$i]);
                if(isset($pays[3])){
                    $listePays[] = $pays;
                }else{
                    $this->command->info('Ligne ='.$tab[$i]);
                }
            }
        }
        return $listePays;
    }
}
