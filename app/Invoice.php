<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const STATUS_PAID = 'Paid';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
