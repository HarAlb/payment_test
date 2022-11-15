<?php

namespace App\Services\Payment\Strategies\SecondStrategy\Requests;

use App\Services\Payment\Enums\PaymentENUM;
use Illuminate\Foundation\Http\FormRequest;

class SecondStrategyConfirmationRequest extends FormRequest
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
            'project' => 'required|numeric',
            'invoice' => 'required|numeric',
            'status' => 'required|string|in:' . implode(',', PaymentENUM::SECOND_STRATEGY_STATUSES),
            'amount' => 'required|numeric',
            'amount_paid' => 'required|numeric',
            'rand' => 'required|string'
        ];
    }
}
