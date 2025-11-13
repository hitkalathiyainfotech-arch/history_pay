<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // User::create([
        //     'first_name' => 'Admin1',
        //     'email' => 'harnisha111gajera@gmail.com',
        //     'email_verified_at' => Carbon::now(),
        //     'password' => Hash::make('harnisha@1086'),
        //     'role' => '1',
        // ]);
    }
}
