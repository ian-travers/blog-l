<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class CheckPermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // get current login
        $currentUser = $request->user();

        // get current action name
        $currentActionName = $request->route()->getActionName();
        list($controller, $method) = explode('@', $currentActionName);
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

        $crudPermissionsMap = [
//            'create' => ['create', 'store'],
//            'read' => ['index', 'show'],
//            'update' => ['edit', 'restore'],
//            'delete' => ['destroy', 'restore', 'forceDestroy'],

            'crud' => ['create', 'store', 'index', 'show','edit', 'restore', 'destroy', 'restore', 'forceDestroy'],
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
//                dd("{$permission}-{$className}");

                if ($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'forceDestroy'])) {
                    // if current user has not update-others-post/delete-others-post permission
                    // make sure he/she only modify his/her own post
                    if ( ($id = $request->route("blog")) && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post')) ) {
                        $post = Post::find($id);
                        if ($post->author_id !== $currentUser->id) {
                            abort(403, "Forbidden access! Only an owner can do it.");
                            dd("HUM");
                        }
                    }

                }

                // if user has not permission don't allow next request
                if (!$currentUser->can("{$permission}-{$className}")) {

                }

                break;
            }
        }

        return $next($request);
    }
}
