<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            "menu"=>[
                [
                    'name'=>'Categories',
                    'route'=>'category.index' ,
                    "active"=>Route::is("category.index") || Route::is("category.create") ||  Route::is("category.edit")
                ],
                [
                    'name'=>'Posts',
                    'route'=>'post.index' ,
                    "active"=>Route::is("post.index") || Route::is("post.create") ||  Route::is("post.edit")
                ],
                [
                    'name'=>'List',
                    'route'=>'post.index' ,
                    "active"=>Route::is("post.index") 
                ],
                
            ],

        ];
    }
}
