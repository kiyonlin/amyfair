<?php

namespace App\Modules\Exhibition;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required',
            'name_en'          => 'required',
            'address'          => 'required',
            'address_en'       => 'required',
            'main_products'    => 'required',
            'main_products_en' => 'required',
            'start_at'         => 'required',
            'end_at'           => 'required'
        ];
    }
}
