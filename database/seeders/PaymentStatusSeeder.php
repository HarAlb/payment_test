<?php

namespace Database\Seeders;

use App\Services\Payment\Enums\PaymentENUM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crDate = date('Y-m-d H:i:s');
        $statuses = collect(PaymentENUM::STATUSES)->map(function ($name) use ($crDate) {
            return [
                'name' => $name,
                'created_at' => $crDate,
                'updated_at' => $crDate
            ];
        })->toArray();
        DB::table('payment_statuses')->insert($statuses);
    }
}
