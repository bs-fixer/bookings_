<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {   
        /* This below method is used for just 1 helper class */
        // $file = app_path('Helpers/Helper.php');
        // if (file_exists($file)) {
        //     require_once($file);
        // }

        /* This method is used for all helpers in the same directory */
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
