<?php

namespace App\Providers;

use App\Http\Livewire\Admin\Content\PostCategoryTable;
use App\Models\Admin\Content\Comment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Livewire::component('post-category-table', PostCategoryTable::class);

        view()->composer('layouts.admin.partials.topnav', function ($view) {
            $view->with('unSeenComment', Comment::where('seen', 0)->get());
        });
    }
}
