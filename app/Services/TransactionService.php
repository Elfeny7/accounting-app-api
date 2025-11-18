<?php

namespace App\Services;

use App\Interfaces\Transaction\TransactionServiceInterface;
use App\Interfaces\Transaction\TransactionRepositoryInterface;
use App\Interfaces\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\DB;

class TransactionService implements TransactionServiceInterface
{
    private TransactionRepositoryInterface $transactionRepositoryInterface;
    private AuthServiceInterface $authServiceInterface;

    public function __construct(TransactionRepositoryInterface $transactionRepositoryInterface, AuthServiceInterface $authServiceInterface)
    {
        $this->transactionRepositoryInterface = $transactionRepositoryInterface;
        $this->authServiceInterface = $authServiceInterface;
    }

    public function getAllTransactions()
    {
        return $this->transactionRepositoryInterface->getAll();
    }

    public function getTransactionById(int $id)
    {
        return $this->transactionRepositoryInterface->getById($id);
    }

    public function createTransaction(array $payload)
    {
        DB::beginTransaction();
        try {
            $transactionDetails = [
                'created_by'       => $this->authServiceInterface->getUser()->id,
                'transaction_date' => $payload['transaction_date'],
                'type'             => $payload['type'],
                'description'      => $payload['description'],
                'amount'           => $payload['amount'],
            ];
            $transaction = $this->transactionRepositoryInterface->create($transactionDetails);

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateTransaction(int $id, array $payload)
    {
        DB::beginTransaction();
        try {
            $existingTransaction = $this->transactionRepositoryInterface->getById($id);
            $transactionDetails = [
                'created_by'       => $this->authServiceInterface->getUser()->id,
                'transaction_date' => $payload['transaction_date'] ?? $existingTransaction->transaction_date,
                'type'             => $payload['type'] ?? $existingTransaction->type,
                'description'      => $payload['description'] ?? $existingTransaction->description,
                'amount'           => $payload['amount'] ?? $existingTransaction->amount,
            ];
            $transaction = $this->transactionRepositoryInterface->update($id, $transactionDetails);

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteTransaction(int $id)
    {
        DB::beginTransaction();
        try {

            $this->transactionRepositoryInterface->delete($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getDailyReport(string $date)
    {
        ['total_income' => $total_income, 'total_expense' => $total_expense] = $this->transactionRepositoryInterface->getIncomeExpenseByDate($date);

        return [
            'date'          => $date,
            'total_income'  => $total_income,
            'total_expense' => $total_expense,
            'balance'       => $total_income - $total_expense,
        ];
    }
}