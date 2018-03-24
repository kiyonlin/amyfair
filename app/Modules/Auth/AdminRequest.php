<?php

namespace App\Modules\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return $this->storeRules();
                break;
            case 'PUT':
            case 'PATCH':
                return $this->updateRules();
                break;
            default:
                $this->failedAuthorization();
        }
    }

    public function updateRules()
    {
        $rules = [
            'name'    => 'required',
            'mobile'  => 'required',
            'email'   => 'required',
            'password'=> 'sometimes|confirmed',
        ];

        $admin = auth()->user();
        if ($admin->email !== request('email')) {
            $rules['email'] = 'required|unique:users,email';
        }

        if ($admin->mobile !== request('mobile')) {
            $rules['mobile'] = 'required|unique:users,mobile';
        }

        return $rules;
    }
}
