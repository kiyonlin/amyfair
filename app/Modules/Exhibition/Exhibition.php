<?php

namespace App\Modules\Exhibition;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $fillable = [
        'name', 'address', 'main_products', 'start_at', 'end_at',
        'name_en', 'address_en', 'main_products_en'
    ];

    /**
     * 应被转换为日期的属性。
     *
     * @var array
     */
    protected $dates = [
        'start_at',
        'end_at',
    ];
}
