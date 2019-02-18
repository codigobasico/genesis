<?php
namespace Modules\Base\Providers;
use Illuminate\Support\ServiceProvider;
class MigrationsProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
