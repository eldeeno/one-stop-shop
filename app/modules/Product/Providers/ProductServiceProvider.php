<?php

namespace App\Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(app_path('Modules/Product/Database/Migrations'));
        $this->mergeConfigFrom(app_path('Modules/Product/Config/config.php'), 'product');
    }
}
