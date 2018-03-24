<?php

namespace App\Modules\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'forbidden',
    ];

    /**
     * Passport 验证
     *
     * @param string $account
     *
     * @return mixed
     */
    public function findForPassport($account)
    {
        return $this->orWhere('email', $account)
        ->orWhere('mobile', $account)->first();
    }

    /**
     * 设置密码时进行加密.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
