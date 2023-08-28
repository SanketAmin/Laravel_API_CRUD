<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUpdateTransaction;
use App\Http\Responses\ApiResponse;
use App\Models\FinancialTransaction;
use App\Services\UserService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use apiResponse;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getAllUserFinancialTransaction(){
        DB::beginTransaction();
        try{
            $user = auth()->guard('api')->user();

            $financeData = $this->userService->getAllUserFinancialTransaction($user->id);

            DB::commit();

            $data = ['all_finance_transactions' => $financeData];

            return $this->successResponse($data, 'Financial transaction fetched successfully', 200);
        }catch (QueryException $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = 'Something Went Wrong';
            return $this->errorResponse($errorMessage, 500);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }

    }

    public function storeFinancialTransaction(CreateUpdateTransaction $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->validated();
            $user = auth()->guard('api')->user();

            $financeData = $this->userService->storeFinancialTransaction($data,$user->id);

            DB::commit();

            $data = ['finance_data' => $financeData, 'user' => $user];

            return $this->successResponse($data, 'Financial Transaction has been created Successfully', 200);
        }catch (QueryException $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = 'Something Went Wrong';
            return $this->errorResponse($errorMessage, 500);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }

    }

    public function updateFinancialTransaction(CreateUpdateTransaction $request)
    {
        DB::beginTransaction();
        try{
            $validated_data = $request->validated();
            $user = auth()->guard('api')->user();

            $check = $this->userService->getFinancialTransaction($validated_data['transaction_id'],$user->id);

            if(!$check){
                $errorMessage = 'Transaction not found';
                return $this->errorResponse($errorMessage, 500);
            }
            $financeData = $this->userService->updateFinancialTransaction($validated_data,$user->id);

            DB::commit();

            $data = ['finance_data' => $financeData];

            return $this->successResponse($data, 'Financial Transaction has been updated Successfully', 200);
        }catch (QueryException $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = 'Something Went Wrong';
            return $this->errorResponse($errorMessage, 500);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }

    }

    public function deleteFinancialTransaction(Request $request){

        DB::beginTransaction();
        try{
            $check = $this->userService->deleteFinancialTransaction($request->transaction_id);

            DB::commit();

            $data = ['finance_data' => null];

            return $this->successResponse($data, 'Financial Transaction has been deleted Successfully', 200);
        }catch (QueryException $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = 'Something Went Wrong';
            return $this->errorResponse($errorMessage, 500);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            DB::rollback();

            $errorMessage = $e->getMessage();
            return $this->errorResponse($errorMessage, 500);
        }

    }
}
