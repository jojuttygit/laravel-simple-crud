<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormRequest extends FormRequest
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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'company' => 'required|exists:companies,company_id',
        ];

        //for update
        if ($this->has('employee_id')) {
            $rules['employee_id'] = 'required|exists:employees,employee_id';
        }

        return $rules;
    }
}
