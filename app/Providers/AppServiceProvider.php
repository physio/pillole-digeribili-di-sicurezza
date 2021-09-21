<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Plugin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       Plugin::encryptUsing(new \RichardStyles\EloquentEncryption\EloquentEncryption);
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
