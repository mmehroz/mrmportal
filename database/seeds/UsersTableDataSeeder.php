<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'faizan.siddiqui.89@gmail.com',
                'password' => bcrypt('delldell'),
                'user_type' => 0,
                'is_customer' => 0,
            ],
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
