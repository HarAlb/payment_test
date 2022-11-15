<?php

namespace App\Console\Commands;

use App\Models\PastPonePayment;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Services\Payment\Enums\PaymentENUM;
use Illuminate\Console\Command;

class ApprovePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will be change status payments that not updated today';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = PastPonePayment::whereRaw('DATE(`created_at`) = CURDATE()')->where('is_completed', false)->get();
        foreach ($payments as $item){
            Payment::where('id', $item->payment_id)
                ->update([
                    'status_id' => $item->status_id,
                    'signature' => $item->signature
                ]);
            $item->is_completed = true;
            $item->save();
        }
    }
}
