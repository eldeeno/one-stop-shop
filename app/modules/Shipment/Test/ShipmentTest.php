<?php

namespace App\Modules\Shipment\Test;

use App\Modules\Shipment\Models\Shipment;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    public function test_it_creates_a_shipment()
    {
        $shipment = new Shipment();

        $this->assertInstanceOf(Shipment::class, $shipment);
        $this->assertTrue(true);
    }
}
