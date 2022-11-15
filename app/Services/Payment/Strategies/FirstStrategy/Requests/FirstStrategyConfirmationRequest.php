<?php

namespace App\Services\Payment\Strategies\FirstStrategy\Requests;

use App\Services\Payment\Enums\PaymentENUM;
use Illuminate\Foundation\Http\FormRequest;

class FirstStrategyConfirmationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'merchant_id' => 'required|numeric',
            'payment_id' => 'required|numeric',
            'status' => 'required|string|in:' . implode(',', PaymentENUM::FIRST_STRATEGY_STATUSES),
            'amount' => 'required|numeric',
            'amount_paid' => 'required|numeric',
            'timestamp' => 'required|numeric',
            'sign' => 'required|string'
        ];
    }
}
