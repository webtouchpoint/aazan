<?php

namespace App\Providers;

use App\Tag;
use App\News;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        \View::composer('*', function($view) {
            $tags = Tag::select('name', 'slug')
                ->get();
            $AllNews = News::select('title', 'filename')
                ->orderBy('id', 'desc')
                ->take(10)
                ->get();
                
            $view->with([
                'tags' => $tags,
                'AllNews' => $AllNews
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
