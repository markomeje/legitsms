<?php

namespace Database\Seeders;
use App\Models\{User, Client};
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('app.env') !== 'production') {
            $users = [
                ['email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active', 'verified' => true, 'username' => 'admin'],
                ['email' => 'user@user.io', 'role' => 'user', 'password' => Hash::make('1234'), 'status' => 'active', 'verified' => true, 'username' => 'user'],
            ];

            User::truncate();
            foreach ($users as $user) {
                User::create($user);
            }
        }
    }
}
