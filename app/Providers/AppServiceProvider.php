<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Rsa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       Rsa::encryptUsing(new \RichardStyles\EloquentEncryption\EloquentEncryption);
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
