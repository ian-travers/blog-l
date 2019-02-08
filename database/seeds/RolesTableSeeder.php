<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->truncate();

        // Create admin role
        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "Admin";
        $admin->save();

        // Create editor role
        $editor = new Role();
        $editor->name = "editor";
        $editor->display_name = "Editor";
        $editor->save();

        // Create author role
        $author = new Role();
        $author->name = "author";
        $author->display_name = "Author";
        $author->save();

        // attach the roles
        // admin
        $user1 = User::find(1);
        $user1->attachRole($admin);

        // editor
        $user2 = User::find(2);
        $user2->attachRole($editor);

        // author
        $user3 = User::find(3);
        $user3->attachRole($author);
    }
}
