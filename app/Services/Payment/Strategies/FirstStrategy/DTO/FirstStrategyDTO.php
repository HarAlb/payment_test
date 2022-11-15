<?php

namespace App\Services\Payment\Strategies\FirstStrategy\DTO;

use App\Services\Payment\DTO\ConfigDTO;
use App\Services\Payment\Interfaces\PaymentDTO;
use App\Services\Payment\Strategies\FirstStrategy\Requests\FirstStrategyConfirmationRequest;

class FirstStrategyDTO implements PaymentDTO
{
    private ConfigDTO $config;
    private int $merchant_id;
    private int $payment_id;
    private string $status;
    private string $amount;
    private string $amount_paid;
    private int $timestamp;
    private string $sign;
    private string $generatedSignature;

    public function __construct(ConfigDTO $config, FirstStrategyConfirmationRequest $request)
    {
        $this->config = $config;
        $this->merchant_id = $request->merchant_id;
        $this->payment_id = $request->payment_id;
        $this->status = $request->status;
        $this->amount = (string) $request->amount;
        $this->amount_paid = $request->amount_paid;
        $this->timestamp = $request->timestamp;
        $this->sign = $request->sign;
        $this->generateSignature($request);
    }

    /**
     * @return ConfigDTO
     */
    public function getConfig(): ConfigDTO
    {
        return $this->config;
    }

    /**
     * @param ConfigDTO $config
     */
    public function setConfig(ConfigDTO $config): void
    {
        $this->config = $config;
    }

    /**
     * @return int|mixed
     */
    public function getMerchantId(): mixed
    {
        return $this->merchant_id;
    }

    /**
     * @param int|mixed $merchant_id
     */
    public function setMerchantId(mixed $merchant_id): void
    {
        $this->merchant_id = $merchant_id;
    }

    /**
     * @return int
     */
    public function getPaymentId(): int
    {
        return $this->payment_id;
    }

    /**
     * @param int|mixed $payment_id
     */
    public function setPaymentId(mixed $payment_id): void
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param mixed|string $status
     */
    public function setStatus(mixed $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed|string
     */
    public function getAmountPaid(): mixed
    {
        return $this->amount_paid;
    }

    /**
     * @param mixed|string $amount_paid
     */
    public function setAmountPaid(mixed $amount_paid): void
    {
        $this->amount_paid = $amount_paid;
    }

    /**
     * @return int|mixed
     */
    public function getTimestamp(): mixed
    {
        return $this->timestamp;
    }

    /**
     * @param int|mixed $timestamp
     */
    public function setTimestamp(mixed $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed|string
     */
    public function getSign(): mixed
    {
        return $this->sign;
    }

    /**
     * @param mixed|string $sign
     */
    public function setSign(mixed $sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return string|void
     */
    public function getGeneratedSignature(): string
    {
        return $this->generatedSignature;
    }

    private function generateSignature(FirstStrategyConfirmationRequest $request)
    {
        $validated = $request->validated();
        unset($validated['sign']);
        sort($validated);
        $signature = implode(':', $validated) . $this->getConfig()->getKey();

        $this->generatedSignature = hash('sha256', $signature);
    }
}
