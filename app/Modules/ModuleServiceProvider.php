<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ModuleServiceProvider
 *
 * @author tiago
 */
class ModuleServiceProvider extends ServiceProvider {
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        $modules = config("module.modules");
        
        foreach($modules as $module){
            
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }
            
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }
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
