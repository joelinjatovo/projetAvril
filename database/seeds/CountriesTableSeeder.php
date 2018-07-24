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
        $items1 = $this->getPaysFromCsv();
        $items2 = $this->getTelsFromCsv();
        $items = array_merge($items1, $items2);
        foreach($items as $code => $item){
            $content = isset($items1[$code]['content'])?$items1[$code]['content']:'';
            $prefixPhone = isset($items2[$code]['prefixPhone'])?$items2[$code]['prefixPhone']:'';
            if(!empty($content)&&!empty($prefixPhone))
            {
                DB::table('countries')->insert([
                    'code' => $code,
                    'content' => $content,
                    'prefixPhone' => $prefixPhone,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
    
    /*
    * Load country code from csv file
    *
    */
    private function getPaysFromCsv(){
        $ligne = 1;
        $fic = fopen(storage_path()."/csv/country-code-fr.csv", "a+");
        $listePays = [];
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $pays = explode(";", $tab[$i]);
                $listePays[$pays[0]] = ['content'=>$pays[1]];
            }
        }
        return $listePays;
    }

    /*
    * Load tel code from csv file
    *
    */
    private function getTelsFromCsv(){
        $ligne = 1;
        $fic = fopen(storage_path()."/csv/tel-code-fr.csv" , "a+");
        $listeContact = array();
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $contact = explode(";", $tab[$i]);
                $listeContact[$contact[0]] = ['prefixPhone'=>$contact[1]];
            }
        }
        return $listeContact;
    }
}
