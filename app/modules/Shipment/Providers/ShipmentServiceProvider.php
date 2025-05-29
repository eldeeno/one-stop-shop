<?php

namespace App\Modules\Shipment\Providers;

use Illuminate\Support\ServiceProvider;

class ShipmentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(app_path('Modules/Shipment/Database/Migrations'));
        $this->mergeConfigFrom(app_path('Modules/Shipment/Config/config.php'), 'shipment');
    }
}
