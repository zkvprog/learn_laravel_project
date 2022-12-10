<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequests extends FormRequest
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
        $rules =  [
            'slug' => 'required|unique:articles|min:3|max:100|alpha_dash',
            'title' => 'required|min:5|max:100',
            'preview' => 'required|max:255',
            'body' => 'required',
            'published' => '',
            'owner_id' => '',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['slug'] = 'required|min:3|max:100|alpha_dash';
        }

        return $rules;
    }
}
