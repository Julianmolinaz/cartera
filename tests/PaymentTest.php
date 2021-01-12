<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\MyService\Payments\Payment;

class PaymentTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $payment = new Payment(9542, 600000);

        $this->assertTrue(true);
        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertClassHasAttribute('credit', Payment::class);
        $this->assertClassHasAttribute('repo', Payment::class);


    }
}
