<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $admin = Role::create(['name' => 'admin', 'description' => 'Administrator']);
        $editor = Role::create(['name' => 'editor', 'description' => 'Editor']);
        $author = Role::create(['name' => 'author', 'description' => 'Author']);

        // Permissions
        $permissions = [
            ['name' => 'view_all_users', 'description' => 'View all users'],
            ['name' => 'assign_roles', 'description' => 'Assign roles'],
            ['name' => 'create_article', 'description' => 'Create article'],
            ['name' => 'edit_own_article', 'description' => 'Edit own article'],
            ['name' => 'publish_article', 'description' => 'Publish article'],
            ['name' => 'delete_article', 'description' => 'Delete article'],
            ['name' => 'view_published', 'description' => 'View published articles'],
            ['name' => 'view_own_articles', 'description' => 'View own articles'],
        ];

        foreach ($permissions as $perm) {
            Permission::create($perm);
        }

        // Attach permissions to roles
        $admin->permissions()->attach(Permission::whereIn('name', [
            'view_all_users',
            'assign_roles',
            'publish_article',
            'delete_article'
        ])->pluck('id'));

        $editor->permissions()->attach(Permission::where('name', 'publish_article')->pluck('id'));

        $author->permissions()->attach(Permission::whereIn('name', [
            'create_article',
            'edit_own_article',
            'view_own_articles'
        ])->pluck('id'));
    }
}
