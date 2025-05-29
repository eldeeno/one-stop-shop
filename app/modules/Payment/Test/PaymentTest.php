<?php

namespace App\Modules\Payment\Test;

use App\Modules\Payment\Models\Payment;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_it_creates_payment()
    {
        $payment = new Payment();

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertTrue(true);
    }
}
