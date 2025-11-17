<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ApiResponse;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Interfaces\Transaction\TransactionServiceInterface;

class TransactionController extends Controller
{
    private TransactionServiceInterface $transactionServiceInterface;

    public function __construct(TransactionServiceInterface $transactionServiceInterface)
    {
        $this->transactionServiceInterface = $transactionServiceInterface;
    }

    public function index()
    {
        $transactions = $this->transactionServiceInterface->getAllTransactions();
        return ApiResponse::success(TransactionResource::collection($transactions), 'Transactions retrieved', 200);
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = $this->transactionServiceInterface->createTransaction($request->getStorePayload());
        return ApiResponse::success(new TransactionResource($transaction), 'Transaction created', 201);
    }

    public function show(int $id)
    {
        $transaction = $this->transactionServiceInterface->getTransactionById($id);
        return ApiResponse::success(new TransactionResource($transaction), 'Transaction retrieved', 200);
    }

    public function update(UpdateTransactionRequest $request, int $id)
    {
        $transaction = $this->transactionServiceInterface->updateTransaction($id, $request->getUpdatePayload());
        return ApiResponse::success(new TransactionResource($transaction), 'Transaction updated', 200);
    }

    public function destroy(int $id)
    {
        $this->transactionServiceInterface->deleteTransaction($id);
        return ApiResponse::success(null, 'Transaction deleted', 204);
    }
}
