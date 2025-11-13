<?php

namespace Database\Seeders;

use App\Models\{User,Role,Permission};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'first_name' => 'Editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('123456'),
                'role' => '1',
            ],
            [
                'first_name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'role' => '1',
            ],
        ];
        User::insert($user);

        Role::insert([
            ['name'=>'Admin','slug'=>'admin'],
            ['name'=>'Editor','slug'=>'editor'],
            ['name'=>'Manager','slug'=>'manager'],
        ]);

        Permission::insert([
            ['name'=>'Add Plan','slug'=>'add-plan'],
            ['name'=>'Edit Plan','slug'=>'edit-plan'],
            ['name'=>'Delete Plan','slug'=>'delete-plan'],
        ]);

        Role::whereId(1)->first()->permission()->attach([1,2,3]);
        Role::whereId(2)->first()->permission()->attach([1,2]);
        Role::whereId(3)->first()->permission()->attach([1]);
    }
}
