<?php

namespace Database\Seeders;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Hash;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            ['name' => 'WhatsApp', 'code' => 1421, 'price' => rand(3500, 4500), 'active' => true],
            ['name' => 'Gmail', 'code' => 6724, 'price' => rand(3500, 4500), 'active' => true],
            ['name' => 'Telegram', 'code' => 1405, 'price' => rand(3500, 4500), 'active' => true],
            ['name' => 'Facebook', 'code' => 1352, 'price' => rand(3500, 4500), 'active' => true],
            ['name' => 'Plenty of Fish', 'code' => 1388, 'price' => rand(3500, 4500), 'active' => true],
        ];

        Website::truncate();
        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
