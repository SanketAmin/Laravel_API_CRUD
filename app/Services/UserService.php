<?php

namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getFinancialTransaction($transaction_id,$user_id)
    {
        return $this->userRepository->getFinancialTransaction($transaction_id,$user_id);
    }
    public function deleteFinancialTransaction($transaction_id)
    {
        return $this->userRepository->deleteFinancialTransaction($transaction_id);
    }
    public function storeFinancialTransaction($data,$user_id)
    {
        return $this->userRepository->storeFinancialTransaction($data,$user_id);
    }

    public function updateFinancialTransaction($data,$user_id)
    {
        return $this->userRepository->updateFinancialTransaction($data,$user_id);
    }

    public function getAllUserFinancialTransaction($user_id)
    {
        return $this->userRepository->getAllUserFinancialTransaction($user_id);
    }

}
