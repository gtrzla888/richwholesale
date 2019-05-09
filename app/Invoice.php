<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Invoice extends Model
{
    const STATUS_PAID = 'Paid';
    const STATUS_INVOICED = 'Invoiced';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
