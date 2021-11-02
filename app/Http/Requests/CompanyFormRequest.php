<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CompanyFormRequest extends FormRequest
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
        //for create
        $rules = [
            'company' => 'required|string',
            'email' => 'required|email',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100',
            'website' => 'url|nullable',
        ];

        //for update
        if ($this->has('company_id')) {
            $rules['company_id'] = 'required|exists:companies,company_id';
            $rules['logo'] = 'image|dimensions:min_width=100,min_height=100|nullable';
        }

        return $rules;
    }
}
