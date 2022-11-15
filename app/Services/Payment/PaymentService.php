<?php

namespace App\Services\Payment;

use App\Services\Payment\Interfaces\PaymentDTO;
use App\Services\Payment\Interfaces\PaymentStrategy;

/**
 * class PaymentService
 *
 * here we just delegated methods
 */
class PaymentService implements PaymentStrategy
{
    private PaymentStrategy $paymentStrategy;

    public function __construct(PaymentStrategy $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function confirm(PaymentDTO $paymentDto)
    {
        return $this->paymentStrategy->confirm($paymentDto);
    }

    public function refund()
    {
        return $this->paymentStrategy->refund();
    }

    public function order()
    {
        return $this->paymentStrategy->refund();
    }

    /**
     * @return PaymentStrategy
     */
    public function getPaymentStrategy(): PaymentStrategy
    {
        return $this->paymentStrategy;
    }

    /**
     * @param PaymentStrategy $paymentStrategy
     */
    public function setPaymentStrategy(PaymentStrategy $paymentStrategy): void
    {
        $this->paymentStrategy = $paymentStrategy;
    }
}
