<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_date' => 'required|date_format:Y-m-d',
            'type'             => 'required|string|in:income,expense',
            'description'      => 'required|string|max:255',
            'amount'           => 'required|integer',
        ];
    }

    public function getStorePayload(): array
    {
        return [
            'transaction_date' => $this->input('transaction_date'),
            'type'             => $this->input('type'),
            'description'      => $this->input('description'),
            'amount'           => $this->input('amount'),
        ];
    }
}
