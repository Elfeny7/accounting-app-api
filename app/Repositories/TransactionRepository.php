<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Interfaces\Transaction\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAll()
    {
        return Transaction::all();
    }

    public function getById(int $id)
    {
        return Transaction::findOrFail($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update(int $id, array $data)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);

        return $transaction;
    }

    public function delete(int $id)
    {
        Transaction::destroy($id);
    }
}
