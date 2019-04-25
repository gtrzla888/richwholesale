<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
