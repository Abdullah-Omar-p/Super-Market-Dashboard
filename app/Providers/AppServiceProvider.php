<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        try {
            DB::connection()->getPdo();
            Schema::disableForeignKeyConstraints();
            Schema::defaultStringLength(191);
            DB::statement('SET SESSION sql_require_primary_key=0');

            } catch (\Exception $e) {
            // die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
