<?php

function check_user_permission($request, $actionName = null, $id = null): bool
{
// get current login
    $currentUser = $request->user();

    // get current action name
    if ($actionName) {
        $currentActionName = $actionName;
    } else {
        $currentActionName = $request->route()->getActionName();
    }

    list($controller, $method) = explode('@', $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

    $crudPermissionsMap = [
//        'create' => ['create', 'store'],
//        'read' => ['index', 'show'],
//        'update' => ['edit', 'restore'],
//        'delete' => ['destroy', 'restore', 'forceDestroy'],
        'crud' => ['create', 'store', 'index', 'show', 'edit', 'restore', 'destroy', 'restore', 'forceDestroy'],
    ];

    $classesMap = [
        'Blog' => 'post',
        'Categories' => 'category',
        'Users' => 'user',
    ];

    foreach ($crudPermissionsMap as $permission => $methods) {

        // if the current method exists in methods list
        // we'll check the permission
        if (in_array($method, $methods) && isset($classesMap[$controller])) {
            $className = $classesMap[$controller];

            if ($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'forceDestroy'])) {
                $id = !is_null($id) ? $id : $request->route("blog");

                // if current user has not update-others-post/delete-others-post permission
                // make sure he/she only modify his/her own post
                if ($id && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post'))) {
                    $post = App\Post::withTrashed()->find($id);
                    if ($post->author_id !== $currentUser->id) {
                        return false;
                    }
                }

            }

            // if user has not permission don't allow next request
            if (!$currentUser->can("{$permission}-{$className}")) {
                return false;
            }

            break;
        }
    }

    return true;
}
