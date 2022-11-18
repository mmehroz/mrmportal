<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call( PermissionTableSeeder::class);
//         $this->call( UsersTableDataSeeder::class);
//         $this->call( RolesTableDataSeeder::class);
//         $this->call( SettingsTableSeeder::class);
    }
}
