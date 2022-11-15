<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\User;
use App\Services\Payment\Enums\PaymentENUM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertAsPayment = [];
        $date = [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $statuses = PaymentStatus::whereIn('name', [PaymentENUM::PENDING, PaymentENUM::CREATED, PaymentENUM::REJECTED, PaymentENUM::EXPIRED])->select([
            'id',
            'name'
        ])->get();
        $userIds = User::select('id')->get();
        for($i = 0; $i < rand(100, 1000); $i++){
            $isSecond = (bool) rand(0,1);
            $amount = (string) rand(120, 5000);
            $insertAsPayment[] = [
                ...[
                    'user_id' => $userIds->random()->first()->id,
                    'merchant_id' => $isSecond ? config('payments.second_strategy_app_id') : config('payments.first_strategy_app_id'),
                    'payment_id' => rand(1,12000),
                    'status_id' => $statuses->random(1)->first()->id,
                    'amount' => $amount,
                    'amount_paid' => $amount,
                ],
                ...$date
            ];
        }

        Payment::insert($insertAsPayment);
    }
}
