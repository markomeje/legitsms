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
                $country['updated_at'] = now();
                $country['created_at'] = now();
                Country::create($country);  
            }       
        }
    }
}