<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const STATUS_ORDERED = 'Ordered';
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
