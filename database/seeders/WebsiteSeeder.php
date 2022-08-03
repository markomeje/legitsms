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
            ['name' => 'WhatsApp', 'code' => 1421],
            ['name' => 'Gmail', 'code' => 6724],
            ['name' => 'Telegram', 'code' => 1405],
            ['name' => 'Facebook', 'code' => 1352],
        ];

        Website::truncate();
        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
