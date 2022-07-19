<?php

namespace Ssgroup\Language;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__.'/database/');
        $this->loadRoutesFrom(__DIR__.'/route.php');
        $this->loadViewsFrom(__DIR__.'/veiws',"ssgrouplanguage");
        $this->publishes([
            __dir__.'/public/' => public_path(""),
            __dir__.'/config/languagesetup.php' => config_path("languagesetup.php"),
        ],'ssgroup');
    }
}
