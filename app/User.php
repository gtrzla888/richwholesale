<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ROLE_WHOLESALE_ADMIN = 'ROLE_WHOLESALE_ADMIN';
    const ROLE_WHOLESALE_USER = 'ROLE_WHOLESALE_ADMIN';
    const ROLE_COMPANY_USER = 'ROLE_COMPANY_USER';
    const ROLE_COMPANY_ADMIN = 'ROLE_COMPANY_ADMIN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function orders()
    {
        return Order
            ::select('orders.*')
            ->join('company_user', 'orders.company_id', '=', 'company_user.company_id')
            ->join('companies', 'companies.id', '=', 'orders.company_id')
            ->join('users', 'users.id', '=', 'company_user.user_id')
            ->where('users.id', $this->id);
    }

    public function getOrdersAttribute()
    {
        return $this->orders()->with('company')->with('items.product')->get();
    }

    public function hasRole($role)
    {
        return $this->role == $role;
    }

    public function getIsCompanyAdminAttribute()
    {
        return $this->role == static::ROLE_COMPANY_ADMIN;
    }

    public function getIsCompanyUserAttribute()
    {
        return $this->role == static::ROLE_COMPANY_USER;
    }

    public function getIsWholesaleAdminAttribute()
    {
        return $this->role == static::ROLE_WHOLESALE_ADMIN;
    }

    public function getIsWholesaleUserAttribute()
    {
        return $this->role == static::ROLE_WHOLESALE_USER;
    }
}
