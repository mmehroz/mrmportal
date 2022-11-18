<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'client_name' => 'dummy-name',
            ],
        ];

        foreach($permissions as $permission) {
            Setting::create($permission);
        }
    }
}
