<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class AbstractRequest extends FormRequest
{
    protected function formatErrors(Validator $validator)
    {   
        return [
            'code' => VALIDATOR_ERROR,
            'status' => false,
            'messages' => $validator->errors()->all(),
        ];
    }
}
