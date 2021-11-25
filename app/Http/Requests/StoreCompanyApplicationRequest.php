<?php

namespace App\Http\Requests;

use App\Models\CompanyApplication;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', [CompanyApplication::class, $this->company]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'description' => ['bail', 'required', 'string', 'min:15']
        ];
    }
}
