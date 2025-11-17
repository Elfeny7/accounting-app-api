<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_date' => 'sometimes|date_format:Y-m-d',
            'type'             => 'sometimes|string|in:income,expense',
            'description'      => 'sometimes|string|max:255',
            'amount'           => 'sometimes|integer',
        ];
    }

    public function getUpdatePayload(): array
    {
        return [
            'transaction_date' => $this->input('transaction_date'),
            'type'             => $this->input('type'),
            'description'      => $this->input('description'),
            'amount'           => $this->input('amount'),
        ];
    }
}
