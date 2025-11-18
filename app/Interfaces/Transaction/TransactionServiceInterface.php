<?php

namespace App\Interfaces\Transaction;

interface TransactionServiceInterface
{
    public function createTransaction(array $payload);
    public function getAllTransactions();
    public function getTransactionById(int $id);
    public function updateTransaction(int $id, array $payload);
    public function deleteTransaction(int $id);
    public function getDailyReport(string $date);
}