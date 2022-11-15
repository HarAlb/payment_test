<?php

namespace App\Services\Payment\Interfaces;

interface PaymentStrategy
{
    public function confirm(PaymentDTO $paymentDto);
    public function order();
    public function refund();
}
