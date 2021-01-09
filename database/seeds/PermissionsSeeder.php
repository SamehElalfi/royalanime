<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // Main roles are listed here
        // Note: the most powerfull role is Super Admin

        // Super Admin Can do almost anything in the app
        // he can Add, Edit and Delete anything
        // Edit Laravel Files
        // Run artisan commands
        // Use phpmyadmin with root permissions
        $role = Role::create(['name' => 'super admin']);

        // Add, Edit and Delete anything
        // Use phpmyadmin as a user
        $admin = Role::create(['name' => 'admin']);

        // Add, Edit, Activate and Delete animes
        // Add, Edit, Activate and Delete episodes
        // Control download and watching servers
        $anime_manager = Role::create(['name' => 'anime manager']);

        // Add, Edit, Activate and Delete animes
        // Control download and watching servers
        $episodes_manager = Role::create(['name' => 'episodes manager']);

        // Write blogposts
        // Update his blogposts
        // Edit, Activate and Delete blogposts
        $blogger = Role::create(['name' => 'blogger']);

        // View Status of the website
        // View google analytics details
        $analyzer = Role::create(['name' => 'analyzer']);

        // Add, Edit, Delete and Activate users
        $user_manager = Role::create(['name' => 'user manager']);

        // Add, Edit, Delete and Comments on animes, episodes and pages
        $comments_manager = Role::create(['name' => 'comments manager']);

        // Can add, edit and remove social media icons and links
        // he can also activate social media widgets in pages
        $social_media_manager = Role::create(['name' => 'social media manager']);

        // ----------------------------------------------------------

        // Here are all permissions for all roles above
        // The Super Admin user has all permission. So, he can do anything

        // The next couple of permissions created for Super Admin only
        // Edit Laravel source Files with online text editor
        $permission = Permission::create(['name' => 'edit laravel files']);
        // Run artisan commands directly from the web browser
        $permission = Permission::create(['name' => 'run artisan commands']);

        // Execut basic sql queries WITHOUT root permissions
        $permission = Permission::create(['name' => 'use mysql']);
        // Use mysql with root permissions
        $permission = Permission::create(['name' => 'use mysql as root']);
        $permission = Permission::create(['name' => 'change settings']);
        $admin->syncPermissions(['use mysql', 'use mysql as root', 'change settings']);


        // Add, Edit, Activate and Delete animes
        // including story, episodes number, MAL id ... etc
        $permission = Permission::create(['name' => 'edit animes']);
        $permission = Permission::create(['name' => 'add animes']);
        $permission = Permission::create(['name' => 'delete animes']);
        $permission = Permission::create(['name' => 'activate animes']);
        $anime_manager->syncPermissions(
            [
                'edit animes',
                'add animes',
                'delete animes',
                'activate animes'
            ]
        );


        // Add, Edit, Activate and Delete episodes
        $permission = Permission::create(['name' => 'edit episodes']);
        $permission = Permission::create(['name' => 'add episodes']);
        $permission = Permission::create(['name' => 'delete episodes']);
        $permission = Permission::create(['name' => 'activate episodes']);
        // Control download and watching servers
        $permission = Permission::create(['name' => 'edit servers']);
        $episodes_manager->syncPermissions(
            [
                'edit servers',
                'edit episodes',
                'add episodes',
                'delete episodes',
                'activate episodes'
            ]
        );


        // Permissons for the blog
        // Add, Update and Delete his blog posts
        $permission = Permission::create(['name' => 'write posts']);
        // Add, Edit, Activate and Delete all blog posts
        $permission = Permission::create(['name' => 'edit posts']);
        $permission = Permission::create(['name' => 'delete posts']);
        $permission = Permission::create(['name' => 'activate posts']);
        $blogger->syncPermissions(
            [
                'write posts',
                'edit posts',
                'delete posts',
                'activate posts'
            ]
        );


        // View Status of the website like:
        // shortlinks status, count of subscripers ... etc
        $permission = Permission::create(['name' => 'view status']);
        // View google analytics details directly from the dashboard
        $permission = Permission::create(['name' => 'view google analytics']);
        $analyzer->syncPermissions(['view status', 'view google analytics']);


        // Add, Edit, Delete and Activate users
        $permission = Permission::create(['name' => 'add users']);
        $permission = Permission::create(['name' => 'edit users']);
        $permission = Permission::create(['name' => 'delete users']);
        $permission = Permission::create(['name' => 'activate users']);
        $user_manager->syncPermissions(
            [
                'add users',
                'edit users',
                'delete users',
                'activate users'
            ]
        );

        // view, delete comments on animes and episodes
        $permission = Permission::create(['name' => 'delete comments']);
        $comments_manager->syncPermissions(['delete comments']);


        // Can add, edit and remove social media icons and links
        $permission = Permission::create(['name' => 'add social links']);
        $permission = Permission::create(['name' => 'edit social links']);
        $permission = Permission::create(['name' => 'delete social links']);
        // Add, edit, delete social media widgets
        // the widgets like share buttons and FB like box ... etc
        $permission = Permission::create(['name' => 'add social widgets']);
        $permission = Permission::create(['name' => 'edit social widgets']);
        $permission = Permission::create(['name' => 'delete social widgets']);
        $social_media_manager->syncPermissions(
            [
                'add social links',
                'edit social links',
                'delete social links',
                'add social widgets',
                'edit social widgets',
                'delete social widgets'
            ]
        );


        // ----------------------------------------------------------

        $user = \App\Models\User::find(1);
        $user->assignRole('super admin');
    }
}
