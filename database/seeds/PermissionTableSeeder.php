<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
//              [
//                  'name' => 'create-brand',
//                  'display_name' => 'Create Brand',
//                  'group' => 'Brand Management'
//              ],
//              [
//                  'name' => 'read-brand',
//                  'display_name' => 'Read Brand',
//                  'group' => 'Brand Management'
//              ],
//              [
//                  'name' => 'update-brand',
//                  'display_name' => 'Update Brand',
//                  'group' => 'Brand Management'
//              ],
//              [
//                  'name' => 'create-user',
//                  'display_name' => 'Create User',
//                  'group' => 'User Management'
//              ],
//              [
//                  'name' => 'read-user',
//                  'display_name' => 'Read User',
//                  'group' => 'User Management'
//              ],
//              [
//                  'name' => 'update-user',
//                  'display_name' => 'Update User',
//                  'group' => 'User Management'
//              ],
//              [
//                  'name' => 'delete-user',
//                  'display_name' => 'Delete User',
//                  'group' => 'User Management'
//              ],
//
//              [
//                  'name' => 'create-role',
//                  'display_name' => 'Create Role',
//                  'group' => 'Role Management'
//              ],
//              [
//                  'name' => 'read-role',
//                  'display_name' => 'Read Role',
//                  'group' => 'Role Management'
//              ],
//              [
//                  'name' => 'update-role',
//                  'display_name' => 'Update Role',
//                  'group' => 'Role Management'
//              ],
//              [
//                  'name' => 'delete-role',
//                  'display_name' => 'Delete Role',
//                  'group' => 'Role Management'
//              ],
//              [
//                  'name' => 'read-order',
//                  'display_name' => 'Read Order',
//                  'group' => 'Order Management'
//              ],
//             [
//                 'name' => 'create-order',
//                 'display_name' => 'Create Order',
//                 'group' => 'Order Management'
//             ],
//              [
//                  'name' => 'update-order',
//                  'display_name' => 'Update Order',
//                  'group' => 'Order Management'
//              ],
//              [
//                  'name' => 'view-logs',
//                  'display_name' => 'Logs',
//                  'group' => 'Logs Management'
//              ],
//                [
//                  'name' => 'create-services',
//                  'display_name' => 'Create Services',
//                  'group' => 'Services Management'
//              ],
//              [
//                  'name' => 'read-services',
//                  'display_name' => 'Read Services',
//                  'group' => 'Services Management'
//              ],
//              [
//                  'name' => 'update-services',
//                  'display_name' => 'Update Services',
//                  'group' => 'Services Management'
//              ],
//                 [
//                  'name' => 'create-profile',
//                  'display_name' => 'Create Profile ',
//                  'group' => 'Profiles Management'
//              ],
//              [
//                  'name' => 'read-profile',
//                  'display_name' => 'Read Profile ',
//                  'group' => 'Profiles Management'
//              ],
//              [
//                  'name' => 'update-profile',
//                  'display_name' => 'Update Profile ',
//                  'group' => 'Profiles Management'
//              ],
//              [
//                  'name' => 'create-project',
//                  'display_name' => 'Create Projects',
//                  'group' => 'Projects Management'
//              ],
//              [
//                  'name' => 'read-project',
//                  'display_name' => 'Read Projects',
//                  'group' => 'Projects Management'
//              ],
//              [
//                  'name' => 'update-project',
//                  'display_name' => 'Update Projects',
//                  'group' => 'Projects Management'
//              ],
//                [
//                  'name' => 'create-daily-target',
//                  'display_name' => 'Create Daily Target',
//                  'group' => 'Daily Targets Management'
//              ],
//              [
//                  'name' => 'read-daily-target',
//                  'display_name' => 'Read Daily Target',
//                  'group' => 'Daily Targets Management'
//              ],
//              [
//                  'name' => 'update-daily-target',
//                  'display_name' => 'Update Daily Target',
//                  'group' => 'Daily Targets Management'
//              ],
//             [
//                  'name' => 'create-reports',
//                  'display_name' => 'Create Reports',
//                  'group' => 'Daily Targets Management'
//              ],
//              [
//                  'name' => 'create-daily-progress',
//                  'display_name' => 'Create Daily Progress',
//                  'group' => 'Daily Progress Management'
//              ],
//              [
//                  'name' => 'read-daily-progress',
//                  'display_name' => 'Read Daily Progress',
//                  'group' => 'Daily Progress Management'
//              ],
//              [
//                  'name' => 'update-daily-progress',
//                  'display_name' => 'Update Daily Progress',
//                  'group' => 'Daily Progress Management'
//              ],
//              [
//                  'name' => 'create-team',
//                  'display_name' => 'Create Team',
//                  'group' => 'Team Management'
//              ],
//              [
//                  'name' => 'read-team',
//                  'display_name' => 'Read Team',
//                  'group' => 'Team Management'
//              ],
//              [
//                  'name' => 'update-team',
//                  'display_name' => 'Update Team',
//                  'group' => 'Team Management'
//              ],
//              [
//                  'name' => 'delete-team',
//                  'display_name' => 'Delete Team',
//                  'group' => 'Team Management'
//              ]
//              ,
//              [
//                  'name' => 'create-leave',
//                  'display_name' => 'Create Leave',
//                  'group' => 'Leave Management'
//              ],
//              [
//                  'name' => 'read-leave',
//                  'display_name' => 'Read Leave',
//                  'group' => 'Leave Management'
//              ],
//              [
//                  'name' => 'update-leave',
//                  'display_name' => 'Update Leave',
//                  'group' => 'Leave Management'
//              ],
//            [
//                  'name' => 'chat-access',
//                  'display_name' => 'Chat Access',
//                  'group' => 'Other Permissions'
//            ],
//            [
//                'name' => 'impersonate-access',
//                'display_name' => 'Impersonate Access',
//                'group' => 'User Management'
//            ],
            [
                'name' => 'summary-leave',
                'display_name' => 'Summary Leave',
                'group' => 'Leave Management'
            ],

        ];

        foreach($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
