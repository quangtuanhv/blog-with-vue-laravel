<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractRequest;

class ImageUploadRequest extends AbstractRequest
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
            'url_file' => 'string',
            'uploads.*' => 'image|mimes:jpg,jpeg,JPEG,png,gif|max:1024',
        ];
    }
}
