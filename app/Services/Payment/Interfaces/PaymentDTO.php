<?php

namespace App\Services\Payment\Interfaces;

use App\Services\Payment\DTO\ConfigDTO;

interface PaymentDTO{
    public function getPaymentId(): int;
    public function getAmount(): string;
    public function getStatus(): string;
    public function getGeneratedSignature(): string;
    public function getConfig(): ConfigDTO;
}
