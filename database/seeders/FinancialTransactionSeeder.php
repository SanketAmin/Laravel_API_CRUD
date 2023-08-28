<?php

namespace Database\Seeders;

use App\Models\FinancialTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FinancialTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [[
                'user_id' => rand(2,5),
                'amount' => rand(100,1000),
                'description' => Str::random(10)
            ],[
                'user_id' => rand(2,5),
                'amount' => rand(100,1000),
                'description' => Str::random(10)
            ],[
                'user_id' => rand(2,5),
                'amount' => rand(100,1000),
                'description' => Str::random(10)
            ],[
                'user_id' => rand(2,5),
                'amount' => rand(100,1000),
                'description' => Str::random(10)
            ],[
                'user_id' => rand(2,5),
                'amount' => rand(100,1000),
                'description' => Str::random(10)
            ]
        ];

        foreach ($array as $arr){
            FinancialTransaction::create($arr);
        }
    }
}
