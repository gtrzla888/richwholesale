<?php

namespace App;

use App\PVCShutter;
use App\RollerBlind;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\AluminiumShutter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    const STATUS_PENDING = 'Pending';
    const STATUS_ORDERED = 'Ordered';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getBasswoodShuttersAttribute()
    {
        return $this->orders()->where('product_type', BasswoodShutter::NAME)->with('items.product')->get()->pluck('items')->flatten(1)->pluck('product');
    }

    public function getPvcShuttersAttribute()
    {
        return $this->orders()->where('product_type', PVCShutter::NAME)->with('items.product')->get()->pluck('items')->flatten(1)->pluck('product');
    }

    public function getAuPvcShuttersAttribute()
    {
        return $this->orders()->where('product_type', AUPVCShutter::NAME)->with('items.product')->get()->pluck('items')->flatten(1)->pluck('product');
    }

    public function getAluminiumShuttersAttribute()
    {
        return $this->orders()->where('product_type', AluminiumShutter::NAME)->with('items.product')->get()->pluck('items')->flatten(1)->pluck('product');
    }

    public function getRollerBlindsAttribute()
    {
        return $this->orders()->where('product_type', RollerBlind::NAME)->with('items.product')->get()->pluck('items')->flatten(1)->pluck('product');
    }

    public function customerQuote()
    {
        return $this->hasOne(CustomerQuote::class);
    }
}
