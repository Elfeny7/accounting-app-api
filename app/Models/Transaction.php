<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['created_by', 'transaction_date', 'type', 'description', 'amount'];
    protected $casts = ['transaction_date' => 'date:Y-m-d'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
