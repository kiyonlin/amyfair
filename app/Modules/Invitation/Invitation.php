<?php

namespace App\Modules\Invitation;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Exhibition\Exhibition;

class Invitation extends Model
{
    protected $fillable = [
        'type', 'email', 'mobile', 'passportNo', 'visaType', 'fullName', 'country', 'industry',

        'gender', 'phone', 'qq', 'wechat', 'whatsapp', 'skype', 'facebook',
        'corpName', 'corpAddr', 'website', 'source', 'intent', 'tradingIntro'
    ];

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class, 'intent');
    }
}
