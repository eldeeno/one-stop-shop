<?php

namespace App\Modules\Order\Providers;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(app_path('Modules/Order/Database/Migrations'));
        $this->mergeConfigFrom(app_path('Modules/Order/Config/config.php'), 'order');
    }
}
