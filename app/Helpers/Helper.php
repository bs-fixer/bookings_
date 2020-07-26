<?php 
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
class Helper
{
    
public static function routes($routes) {
    foreach($routes as $key => $route) {
        if (is_array($route)) {
            self::route($route[0], $route[1]);
        } else {
            self::route($route);
        }
        self::route($route);
    }
}


public static function route($base, $args = []) {
    
    $parts = explode('/', $base);

    if (!isset($model)) {
        $model = end($parts);
    }
    if (!isset($controller)) {
        $controller = ucwords($model).'Controller';
    }
    
    if (!isset($basename)) {
        $basename ='';
        foreach($parts as $part) {
            if (!Str::of($part)->contains('{')) {
                $basename .= $part.'.';
            }
        }
    }
    if (!isset($pages)) {
        $pages = ['index', 'create', 'show', 'store', 'edit', 'update', 'destroy'];
    }
    $defaultmap = [
            'index' =>  [
                            'method'    => 'get',
                            'path'      => $base,
                            'name'      => 'index',
                        ],
            'create'=>  [
                            'method'    => 'get',
                            'path'      => $base.'/create',
                            'name'      => 'create',
                        ],
            'show'  =>  [
                            'method'    => 'get',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'show',
                        ],
            'store' =>  [
                            'method'    => 'post',
                            'path'      => $base,
                            'name'      => 'store',
                        ],
            'edit'  =>  [
                            'method'    => 'get',
                            'path'      => $base.'/{'.$model.'_id}/edit',
                            'name'      => 'edit',
                        ],
            'update'=>  [
                            'method'    => 'put',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'update',
                        ],
            'destroy'=> [
                            'method'    => 'delete',
                            'path'      => $base.'/{'.$model.'_id}',
                            'name'      => 'destroy',
                        ],
            ];

    
    if (!isset($map)) {
        $map = $defaultmap;
    } else {
        $map = array_replace_recursive($defaultmap, $map);
    }
    foreach($pages as $page) {
        extract($map[$page]);
        Route::$method($path, $controller.'@'.$page)->name(trim($basename.$name, '.'));
    }
    
}




}
?>