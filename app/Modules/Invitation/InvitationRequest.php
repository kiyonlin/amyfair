<?php

namespace App\Modules\Invitation;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'type'     => 'required|in:supplier,buyer',
            'email'    => 'required|email',
            'mobile'   => 'required',
            'country'  => 'required',
            'industry' => 'required',
            'visaType' => 'required|in:work,student,tourist',
        ];
    }
}
