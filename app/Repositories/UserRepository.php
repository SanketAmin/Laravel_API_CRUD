<?php

namespace App\Repositories;

use App\Models\FinancialTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function storeFinancialTransaction($data,$user_id)
    {
        return FinancialTransaction::create([
            'user_id' => $user_id,
            'amount' => $data['amount'],
            'description'=> $data['description']
        ]);
    }

    public function getAllUserFinancialTransaction($user_id){
        return FinancialTransaction::with('user')->where('user_id', $user_id)->get();
    }

    public function getFinancialTransaction($transaction_id,$user_id){
        return FinancialTransaction::with('user')->where(['id' => $transaction_id, 'user_id'=> $user_id])->first();
    }

    public function deleteFinancialTransaction($transaction_id){
        return FinancialTransaction::where('id', $transaction_id)->delete();
    }

    public function updateFinancialTransaction($data,$user_id){
        $model = FinancialTransaction::findOrFail($data['transaction_id']);
        $model->update([
            'amount' => $data['amount'],
            'description'=> $data['description']
        ]);
        return $model;
    }


}
