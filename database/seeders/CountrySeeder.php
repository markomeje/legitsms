<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Country};
   
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('countries.json');
        $countries = json_decode(file_get_contents($path), true);

        Country::truncate();
        foreach ($countries as $country) {
            if (!empty($country['name'])) {
                $phonecode = (string)$country['phonecode'];
                $id_number = (string)$country['id_number'];
                $country['phonecode'] = str_contains($phonecode, '+') ? $phonecode : '+'.$phonecode;
                $country['id_number'] = strlen($id_number) > 2 ? substr($id_number, 0, 2) : $id_number;
                $country['updated_at'] = now();
                $country['created_at'] = now();
                unset($country['currency']);
                Country::create($country);  
            }       
        }
    }
}