<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_MANUFACTURING = 'Manufacturing';
    const STATUS_COMPLETED = 'Completed';

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    
}
