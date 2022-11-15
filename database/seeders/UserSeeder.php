<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $cr_date = date('Y-m-d H:i:s');
        $now = now();
        for($i = 0 ; $i < 100 ; $i++){
            $insert[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => $now,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at' => $cr_date,
                'updated_at' => $cr_date
            ];
        }
        \App\Models\User::insert($insert);
    }
}
