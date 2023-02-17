<?php

namespace App\Providers;

use App\Models\EtalaseGroup;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // jika running di console, maka tidak perlu dijalankan
        if (!App::runningInConsole()) {
            // save etalase_menu to cache 1 hour
            $menu_etalase = Cache::remember('etalase_menu', 60, function () {
                $etalase = EtalaseGroup::all();
                $etalase->load('etalase');
                $menu_etalase = [];
                foreach ($etalase as $value) {
                    array_push($menu_etalase, [
                        'name' => $value->name,
                        'slug' => $value->slug,
                        'stack' => Arr::pluck($value->etalase, 'slug', 'name')
                    ]);
                }
                return $menu_etalase;
            });
            // share etalase_menu
            App::singleton('etalase_menu', fn () => $menu_etalase);
            view()->share('etalase_menu', $menu_etalase);
        }
    }
}
