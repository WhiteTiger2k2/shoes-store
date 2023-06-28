<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            ['Trả tiền mặt khi nhận hàng', 1],
            ['Chuyển khoản ngân hàng', 1],
        ];

        foreach($payments as $payment) {
            Payment::create([
                'payment_method' => $payment[0],
                'status' => $payment[1],
            ]);
        }
    }
}
