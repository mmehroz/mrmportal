<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'customer',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'owner',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'sales',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'bidder',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'manager',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'hr',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'developer',
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'designer',
                'status' => 1,
                'user_id' => 1,
            ],
        ];

        foreach($roles as $role) {
            Role::create($role);
        }
    }
}
