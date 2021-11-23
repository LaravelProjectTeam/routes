<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SendGrid;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SendGrid::class, function () {
            return new SendGrid(getenv('SENDGRID_API_KEY'));
        });
    }
}
