<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissonRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan db:seed --class=PermissonRoleSeeder

        // Define the specific values for each role and permission
        $permissions = [
            ['name' => 'read_users', 'description' => 'Allows user to view other users profiles', 'status' => '1'],
            ['name' => 'edit_profile', 'description' => 'Allows user to edit their own profile', 'status' => '0'],
            ['name' => 'delete_comments', 'description' => 'Allows user to delete comments on a post', 'status' => '1'],
            ['name' => 'post_photos', 'description' => 'Allows user to upload photos to their profile', 'status' => '0'],
            ['name' => 'create_events', 'description' => 'Allows user to create new events', 'status' => '1'],
            ['name' => 'send_messages', 'description' => 'Allows user to send private messages to others', 'status' => '1'],
            ['name' => 'view_stats', 'description' => 'Allows user to view website analytics', 'status' => '1'],
            ['name' => 'manage_ads', 'description' => 'Allows user to create and manage advertisements', 'status' => '1'],
            ['name' => 'modify_settings', 'description' => 'Allows user to modify account settings', 'status' => '1'],
            ['name' => 'access_admin', 'description' => 'Allows user to access the admin dashboard', 'status' => '1'],
        ];

        $roles = [
            ['name' => 'Admin', 'description' => 'Has access to all features and controls within the system', 'status' => '1'],
            ['name' => 'Editor', 'description' => 'Can create, edit, and delete content', 'status' => '0'],
            ['name' => 'Moderator', 'description' => 'Monitors user-generated content for appropriateness', 'status' => '0'],
            ['name' => 'Customer Support', 'description' => 'Provides customer service and support', 'status' => '1'],
            ['name' => 'Analyst', 'description' => 'Analyzes data and generates reports', 'status' => '1'],
            ['name' => 'Sales Representative', 'description' => 'Contacts and sells products/services to customers', 'status' => '1'],
            ['name' => 'Developer', 'description' => 'Builds and maintains the system', 'status' => '1'],
            ['name' => 'Quality Assurance', 'description' => 'Tests and ensures the quality of the system', 'status' => '1'],
            ['name' => 'Marketing', 'description' => 'Develops and implements marketing strategies', 'status' => '1'],
            ['name' => 'HR', 'description' => 'Manages human resources functions such as hiring, training, and benefits', 'status' => '1'],
        ];


        // Insert the values into the database
        DB::table('permissions')->insert($permissions);
        DB::table('roles')->insert($roles);


        for ($i = 1; $i <= 10; $i++) {
            DB::table('permission_role')->insert([
                'permission_id' => $i,
                'role_id' => $i,
            ]);
        }


        for ($i = 1; $i <= 10; $i++) {
            DB::table('role_user')->insert([
                'user_id' => $i,
                'role_id' => $i,
            ]);
        }
    }
}
