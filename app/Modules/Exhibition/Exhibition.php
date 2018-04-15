<?php

namespace App\Modules\Exhibition;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $fillable = [
        'name', 'address', 'main_products', 'start_at', 'end_at',
        'name_en', 'address_en', 'main_products_en'
    ];

    public function getStartAtAttribute($value)
    {
        if ($value) {
            return $this->attributes['start_at'] = is_string($value) ?
                substr($value, 0, 10) :
                substr($value->toDateTimeString(), 0, 10);
        }
        return $value;
    }

    public function getEndAtAttribute($value)
    {
        if ($value) {
            return $this->attributes['end_at'] = is_string($value) ?
                substr($value, 0, 10) :
                substr($value->toDateTimeString(), 0, 10);
        }
        return $value;
    }
}
