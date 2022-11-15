<?php

namespace App\Services\Payment\Strategies\SecondStrategy;

use App\Models\PastPonePayment;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Services\Payment\Enums\PaymentENUM;
use App\Services\Payment\Interfaces\PaymentDTO;
use App\Services\Payment\Interfaces\PaymentStrategy;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SecondStrategy implements PaymentStrategy
{
    public function confirm(PaymentDTO $paymentDto)
    {
        $existsID = Payment::where([
            'payment_id' => $paymentDto->getPaymentId(),
            'merchant_id' => $paymentDto->getConfig()->getId(),
        ])->whereIn(
            'status_id',
            PaymentStatus::whereIn('name', [PaymentENUM::CREATED, PaymentENUM::IN_PROGRESS])->select('id')
        )->value('id');
        if (!$existsID) {
            throw new ModelNotFoundException();
        }
        $updatesToday = Payment::whereRaw('DATE(`updated_at`) = CURDATE()')->count('id');
        if ($updatesToday > PaymentENUM::FIRST_STRATEGY_UPDATE_COUNT) {
            $exists = (bool) PastPonePayment::whereRaw('DATE(`created_at`) = CURDATE()')
                ->where([
                    'payment_id' => $paymentDto->getPaymentId()
                ])->value('id');
            if ($exists) {
                return;
            }
            PastPonePayment::create([
                'payment_id' => $existsID,
                'status_id' => PaymentStatus::where('name', $paymentDto->getStatus())->value('id'),
                'signature' => $paymentDto->getGeneratedSignature()
            ]);
            return;
        }
        Payment::where([
            'payment_id' => $paymentDto->getPaymentId(),
            'merchant_id' => $paymentDto->getConfig()->getId(),
        ])->update([
            'status_id' => PaymentStatus::where('name', $paymentDto->getStatus())->value('id'),
            'signature' => $paymentDto->getGeneratedSignature()
        ]);
    }

    public function order()
    {
        // TODO: Implement order() method.
    }

    public function refund()
    {
        // TODO: Implement refund() method.
    }
}
