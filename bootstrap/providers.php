<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Modules\Order\Providers\OrderServiceProvider::class,
    App\Modules\Payment\Providers\PaymentServiceProvider::class,
    App\Modules\Product\Providers\ProductServiceProvider::class,
    App\Modules\Shipment\Providers\ShipmentServiceProvider::class,
];
