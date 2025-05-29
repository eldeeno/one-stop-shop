<?php

namespace App\Modules\Payment\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(app_path('Modules/Payment/Database/Migrations'));
        $this->mergeConfigFrom(app_path('Modules/Payment/Config/config.php'), 'payment');
    }
}
