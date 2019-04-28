<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerQuote extends Model
{
    public  function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
