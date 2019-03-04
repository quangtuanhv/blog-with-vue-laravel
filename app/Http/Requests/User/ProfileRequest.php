<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractRequest;
use Carbon\Carbon;

class ProfileRequest extends AbstractRequest
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
            'name' => 'required',
            'birthday' => 'date|before:today',
            'phone' => 'numeric|digits_between:9,12',
            'about' => 'min:10',
        ];
    }
}
