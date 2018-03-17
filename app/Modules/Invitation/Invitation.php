<?php

namespace App\Modules\Invitation;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'type', 'email', 'mobile', 'fullName', 'country', 'industry',

        'gender', 'phone', 'qq', 'wechat', 'whatsapp', 'skype', 'facebook',
        'corpName', 'corpAddr', 'website', 'source', 'intent', 'tradingIntro'
    ];
}
