<?php

namespace App\Providers;

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
    $this->app->singleton(\App\Services\FonnteService::class, function ($app) {
        // Mendaftarkan binding singleton di Laravel Service Container
        // Artinya, ketika class FonnteService diminta (di-inject), 
        // Laravel hanya akan membuat satu instance saja selama lifecycle aplikasi
        // dan mengembalikan instance yang sama setiap kali dibutuhkan.
        
        // Fungsi closure ini bertugas membuat instance baru dari FonnteService
        return new \App\Services\FonnteService();
    });

}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
