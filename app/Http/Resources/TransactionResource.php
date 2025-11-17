<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_by' => $this->created_by,
            'transaction_date' => $this->transaction_date->format('Y-m-d'),
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
        ];
    }
}
