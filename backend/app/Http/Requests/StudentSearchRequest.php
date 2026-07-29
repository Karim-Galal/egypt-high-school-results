<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidation(): void
    {
        if ($this->filled('arabic_name')) {
            $this->merge([
                'arabic_name' => preg_replace('/\s+/', ' ', trim($this->arabic_name)),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'seating_no' => [
                'nullable',
                'integer',

                'required_without:arabic_name',
            ],

            'arabic_name' => [
                'nullable',
                'string',
                'required_without:seating_no',
            ],
        ];
    }



    public function messages(): array
    {
        return [
            'seating_no.required_without' => 'يرجى إدخال رقم الجلوس أو الاسم الرباعي.',
            'arabic_name.required_without' => 'يرجى إدخال رقم الجلوس أو الاسم الرباعي.',

            'seating_no.integer' => 'رقم الجلوس يجب أن يكون رقماً صحيحاً.',

            'seating_no.prohibits' => 'يمكن البحث برقم الجلوس أو الاسم فقط، وليس كليهما.',
            'arabic_name.prohibits' => 'يمكن البحث برقم الجلوس أو الاسم فقط، وليس كليهما.',
        ];
    }


    public function attributes(): array
    {
        return [
            'seating_no' => 'رقم الجلوس',
            'arabic_name' => 'الاسم الرباعي',
        ];
    }



}
