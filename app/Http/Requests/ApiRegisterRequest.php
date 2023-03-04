<?php

namespace App\Http\Requests;

use App\Rules\ApiDuplicateEmailUserRule;
use Illuminate\Foundation\Http\FormRequest;

class ApiRegisterRequest extends FormRequest
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
        return [
            'email' => [
                'required',
                'email',
                new ApiDuplicateEmailUserRule
            ],
            'password' => 'required|min:6',
            'name' => 'required|max:150'
        ];
    }
}
