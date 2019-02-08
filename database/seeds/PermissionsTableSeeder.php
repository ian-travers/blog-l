<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->truncate();

        // crud post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->display_name = "CRUD Post";
        $crudPost->description = "CRUD Own Post";
        $crudPost->save();

        // update others post
        $updateOthersPost = new Permission();
        $updateOthersPost->name = "update-others-post";
        $updateOthersPost->display_name = "Update Others Post";
        $updateOthersPost->description = "Update others author post";
        $updateOthersPost->save();

        // delete others post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = "delete-others-post";
        $deleteOthersPost->display_name = "Delete Others Post";
        $deleteOthersPost->description = "Delete others author post";
        $deleteOthersPost->save();

        // crud category
        $crudCategory = new Permission();
        $crudCategory->name = "crud-category";
        $crudCategory->display_name = "CRUD Category";
        $crudCategory->description = "CRUD Category";
        $crudCategory->save();

        // crud user
        $crudUser = new Permission();
        $crudUser->name = "crud-user";
        $crudUser->display_name = "CRUD User";
        $crudUser->description = "CRUD User";
        $crudUser->save();

        // attach permossions to the roles
        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory, $crudUser]);
        $admin->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory, $crudUser]);
        $editor->detachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory]);
        $editor->attachPermissions([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory]);
        $author->detachPermission($crudPost);
        $author->attachPermission($crudPost);
    }
}
